; (function () {
  'use strict';

  var LAUNCH_PRICES = {
    0: 0,
    1: 69,
    2: 109,
    3: 149,
    4: 199,
    5: 199
  };
  var INCLUDED_EMPLOYEES = 5;
  var EMPLOYEE_PRICE = 12;
  var CONSULTING_PRICE = 89;

  function initPricingConfigurator() {
    var root = document.querySelector('.pricing-configurator-page');
    if (!root) return;

    var moduleButtons = Array.from(root.querySelectorAll('[data-pricing-module]'));
    var tierItems = Array.from(root.querySelectorAll('[data-pricing-tier]'));
    var countrySelect = root.querySelector('[data-pricing-country]');
    var canadaRegion = root.querySelector('[data-pricing-canada-region]');
    var canadaRateSelect = root.querySelector('[data-pricing-canada-rate]');
    var taxNotes = Array.from(root.querySelectorAll('[data-pricing-tax-note]'));
    var cta = root.querySelector('[data-pricing-cta]');
    var selectedModules = new Set();
    var employees = INCLUDED_EMPLOYEES;
    var consulting = 0;

    var outputs = {
      employees: root.querySelector('[data-pricing-employees]'),
      consulting: root.querySelector('[data-pricing-consulting]'),
      selectedCount: root.querySelector('[data-pricing-selected-count]'),
      emptySelection: root.querySelector('[data-pricing-selection-empty]'),
      countSelection: root.querySelector('[data-pricing-selection-count-wrap]'),
      launchPrice: root.querySelector('[data-pricing-launch-price]'),
      regularPrice: root.querySelector('[data-pricing-regular-price]'),
      planPrice: root.querySelector('[data-pricing-plan-price]'),
      employeesPrice: root.querySelector('[data-pricing-employees-price]'),
      monthlySubtotal: root.querySelector('[data-pricing-monthly-subtotal]'),
      consultingPrice: root.querySelector('[data-pricing-consulting-price]'),
      taxLabel: root.querySelector('[data-pricing-tax-label]'),
      taxPrice: root.querySelector('[data-pricing-tax-price]'),
      firstTotal: root.querySelector('[data-pricing-first-total]'),
      recurringTotal: root.querySelector('[data-pricing-recurring-total]'),
      pendingTax: root.querySelector('[data-pricing-pending-tax]'),
      pendingTaxLabel: root.querySelector('[data-pricing-tax-pending-label]')
    };

    function currentLocale() {
      return document.documentElement.getAttribute('data-locale') ||
        document.documentElement.getAttribute('data-server-locale') ||
        'es-MX';
    }

    function formatUsd(value) {
      var hasCents = Math.abs(value % 1) > 0.001;
      try {
        return new Intl.NumberFormat(currentLocale(), {
          style: 'currency',
          currency: 'USD',
          minimumFractionDigits: hasCents ? 2 : 0,
          maximumFractionDigits: 2
        }).format(value);
      } catch (error) {
        return '$' + value.toFixed(hasCents ? 2 : 0) + ' USD';
      }
    }

    function resolveTax() {
      var country = countrySelect.value;

      if (country === 'MX') {
        return { rate: 0.16, label: 'IVA 16%' };
      }
      if (country === 'CO') {
        return { rate: 0.19, label: 'IVA 19%' };
      }
      if (country === 'CA') {
        var selectedOption = canadaRateSelect.options[canadaRateSelect.selectedIndex];
        return {
          rate: Number(canadaRateSelect.value),
          label: selectedOption ? selectedOption.getAttribute('data-tax-label') : 'GST/HST'
        };
      }

      return {
        rate: null,
        label: outputs.pendingTaxLabel ? outputs.pendingTaxLabel.textContent : '—'
      };
    }

    function updateTaxControls() {
      var country = countrySelect.value;
      canadaRegion.hidden = country !== 'CA';
      taxNotes.forEach(function (note) {
        note.hidden = note.getAttribute('data-pricing-tax-note') !== country;
      });
    }

    function updateStepperButtons() {
      root.querySelectorAll('[data-pricing-stepper="employees"]').forEach(function (button) {
        var direction = Number(button.getAttribute('data-direction'));
        button.disabled = (direction < 0 && employees <= INCLUDED_EMPLOYEES) || (direction > 0 && employees >= 100);
      });
      root.querySelectorAll('[data-pricing-stepper="consulting"]').forEach(function (button) {
        var direction = Number(button.getAttribute('data-direction'));
        button.disabled = (direction < 0 && consulting <= 0) || (direction > 0 && consulting >= 20);
      });
    }

    function update() {
      var moduleCount = selectedModules.size;
      var launchBase = LAUNCH_PRICES[moduleCount] || 0;
      var regularBase = launchBase * 2;
      var extraEmployees = Math.max(0, employees - INCLUDED_EMPLOYEES);
      var employeesMonthly = extraEmployees * EMPLOYEE_PRICE;
      var consultingOneTime = consulting * CONSULTING_PRICE;
      var monthlySubtotal = launchBase + employeesMonthly;
      var firstSubtotal = monthlySubtotal + consultingOneTime;
      var tax = resolveTax();
      var firstTax = tax.rate === null ? null : firstSubtotal * tax.rate;
      var recurringTax = tax.rate === null ? null : monthlySubtotal * tax.rate;
      var firstTotal = firstSubtotal + (firstTax || 0);
      var recurringTotal = monthlySubtotal + (recurringTax || 0);

      moduleButtons.forEach(function (button) {
        var isSelected = selectedModules.has(button.getAttribute('data-pricing-module'));
        button.classList.toggle('is-selected', isSelected);
        button.setAttribute('aria-pressed', isSelected ? 'true' : 'false');
      });

      tierItems.forEach(function (item) {
        var tier = Number(item.getAttribute('data-pricing-tier'));
        var isActive = moduleCount === tier || (tier === 4 && moduleCount >= 4);
        item.classList.toggle('is-active', isActive);
      });

      outputs.employees.textContent = String(employees);
      outputs.consulting.textContent = String(consulting);
      outputs.selectedCount.textContent = String(moduleCount);
      outputs.emptySelection.hidden = moduleCount > 0;
      outputs.countSelection.hidden = moduleCount === 0;
      outputs.launchPrice.textContent = formatUsd(launchBase);
      outputs.regularPrice.textContent = formatUsd(regularBase);
      outputs.planPrice.textContent = formatUsd(launchBase);
      outputs.employeesPrice.textContent = formatUsd(employeesMonthly);
      outputs.monthlySubtotal.textContent = formatUsd(monthlySubtotal);
      outputs.consultingPrice.textContent = formatUsd(consultingOneTime);
      outputs.taxLabel.textContent = tax.label;
      outputs.taxPrice.textContent = firstTax === null ? '—' : formatUsd(firstTax);
      outputs.firstTotal.textContent = formatUsd(firstTotal);
      outputs.recurringTotal.textContent = formatUsd(recurringTotal);
      outputs.pendingTax.hidden = tax.rate !== null;

      cta.classList.toggle('is-disabled', moduleCount === 0);
      cta.setAttribute('aria-disabled', moduleCount === 0 ? 'true' : 'false');
      updateStepperButtons();
    }

    moduleButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        var moduleId = button.getAttribute('data-pricing-module');
        if (selectedModules.has(moduleId)) {
          selectedModules.delete(moduleId);
        } else {
          selectedModules.add(moduleId);
        }
        update();
      });
    });

    root.querySelector('[data-pricing-select-all]').addEventListener('click', function () {
      moduleButtons.forEach(function (button) {
        selectedModules.add(button.getAttribute('data-pricing-module'));
      });
      update();
    });

    root.querySelector('[data-pricing-clear]').addEventListener('click', function () {
      selectedModules.clear();
      update();
    });

    root.querySelectorAll('[data-pricing-stepper]').forEach(function (button) {
      button.addEventListener('click', function () {
        var target = button.getAttribute('data-pricing-stepper');
        var direction = Number(button.getAttribute('data-direction'));
        if (target === 'employees') {
          employees = Math.min(100, Math.max(INCLUDED_EMPLOYEES, employees + direction));
        } else {
          consulting = Math.min(20, Math.max(0, consulting + direction));
        }
        update();
      });
    });

    countrySelect.addEventListener('change', function () {
      updateTaxControls();
      update();
    });
    canadaRateSelect.addEventListener('change', update);

    cta.addEventListener('click', function (event) {
      if (cta.getAttribute('aria-disabled') === 'true') {
        event.preventDefault();
        moduleButtons[0].focus();
      }
    });

    var supportedCountries = ['MX', 'CA', 'US', 'CO', 'BR'];
    var serverCountry = document.documentElement.getAttribute('data-server-country');
    var localeCountry = {
      'es-MX': 'MX',
      'es-CO': 'CO',
      'en-CA': 'CA',
      'fr-CA': 'CA',
      'zh-CA': 'CA',
      'ko-CA': 'CA',
      'pt-BR': 'BR'
    };
    var detectedCountry = supportedCountries.indexOf(serverCountry) >= 0
      ? serverCountry
      : (localeCountry[currentLocale()] || 'MX');
    countrySelect.value = detectedCountry;
    if (detectedCountry === 'CA') {
      canadaRateSelect.value = '0.13';
    }

    var localeObserver = new MutationObserver(function (mutations) {
      if (mutations.some(function (mutation) { return mutation.attributeName === 'data-locale'; })) {
        update();
      }
    });
    localeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['data-locale'] });

    updateTaxControls();
    update();
  }

  document.addEventListener('DOMContentLoaded', initPricingConfigurator);
})();
