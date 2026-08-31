<?php
require_once __DIR__ . '/functions.php';
$siteCtx = resolveSiteContext();
$serverLocale  = $siteCtx['locale'];
$serverCountry = $siteCtx['country'];
$serverLang    = strtolower($serverLocale);

$localeOptions = [
  'es-MX' => 'Español · MX',
  'es-CO' => 'Español · CO',
  'en-CA' => 'English · CA',
  'fr-CA' => 'Français · CA',
  'zh-CA' => '中文 · CA',
  'ko-CA' => '한국어 · CA',
  'pt-BR' => 'Português · BR',
];

$localeFlags = [
  'es-MX' => '/imgs/flags/mx.svg',
  'es-CO' => '/imgs/flags/co.svg',
  'en-CA' => '/imgs/flags/ca.svg',
  'fr-CA' => '/imgs/flags/ca.svg',
  'zh-CA' => '/imgs/flags/ca.svg',
  'ko-CA' => '/imgs/flags/ca.svg',
  'pt-BR' => '/imgs/flags/br.svg',
];

$selectedLocaleFlag = $localeFlags[$serverLocale] ?? '/imgs/flags/default.svg';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($serverLang, ENT_QUOTES) ?>"
      data-server-locale="<?= htmlspecialchars($serverLocale, ENT_QUOTES) ?>"
      data-server-country="<?= htmlspecialchars((string)$serverCountry, ENT_QUOTES) ?>"
      data-locale-override="<?= $siteCtx['userOverride'] ? '1' : '0' ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' | Índice' : 'Índice'; ?></title>
  <meta name="description" content="<?php echo isset($page_description) ? htmlspecialchars($page_description) : 'Índice — ecosistema de soluciones para empresas'; ?>">
  <?php echo csrfMetaTag(); ?>

  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Estilos del sitio -->
  <link rel="stylesheet" href="/css/brand.css">
  <link rel="stylesheet" href="/css/style.css?v=20260831-2">
  <link rel="icon" type="image/svg+xml" href="/imgs/logo-mark.svg">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container">
    <a class="navbar-brand navbar-brand-logo" href="/index.php" aria-label="Índice">
      <span class="brand-logo-crop" aria-hidden="true">
        <img src="/imgs/indice-logo-official.png" alt="" class="brand-logo-img" width="900" height="600" decoding="async">
      </span>
      <span class="visually-hidden">Índice</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
        <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF'])=='index.php')?'active':''; ?>" href="/index.php" data-i18n="nav.home">Inicio</a></li>
        <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF'])=='metodologia.php')?'active':''; ?>" href="/metodologia.php" data-i18n="nav.methodology">Cómo funciona</a></li>
        <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF'])=='modulos.php')?'active':''; ?>" href="/modulos.php" data-i18n="nav.modules">Módulos</a></li>
        <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF'])=='modo-aprendiz.php')?'active':''; ?>" href="/modo-aprendiz.php" data-i18n="nav.apprentice">Modo aprendiz</a></li>
        <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF'])=='planes.php')?'active':''; ?>" href="/planes.php" data-i18n="nav.plans">Planes</a></li>
        <li class="nav-item ms-lg-2 me-lg-2 mt-2 mt-lg-0">
          <label class="visually-hidden" for="localeSelector" data-i18n="nav.countryLabel">País e idioma</label>
          <div class="locale-selector-wrap">
            <img id="localeFlagBadge" class="locale-flag-badge" src="<?= htmlspecialchars($selectedLocaleFlag, ENT_QUOTES) ?>" alt="" width="20" height="14" loading="lazy" decoding="async" aria-hidden="true">
            <select id="localeSelector" class="form-select form-select-sm locale-selector" aria-label="Seleccionar país e idioma" data-i18n-aria-label="nav.countryLabel">
<?php foreach ($localeOptions as $code => $label):
    $sel = ($code === $serverLocale) ? ' selected' : '';
?>
              <option value="<?= $code ?>"<?= $sel ?>><?= $label ?></option>
<?php endforeach; ?>
            </select>
          </div>
        </li>
        <li class="nav-item ms-lg-1"><a class="nav-link btn-nav-cta" href="<?= getIndiceLoginUrlAttr() ?>" data-i18n="nav.login">Iniciar sesión</a></li>
      </ul>
    </div>
  </div>
</nav>
