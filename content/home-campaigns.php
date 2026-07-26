<?php

function normalizeHomeCampaignCountry($country) {
    $country = strtoupper(preg_replace('/[^A-Za-z]/', '', (string)$country));
    return preg_match('/^[A-Z]{2}$/', $country) ? $country : 'GLOBAL';
}

function getHomeCampaignForCountry($country) {
    $country = normalizeHomeCampaignCountry($country);

    $campaigns = [
        'MX' => [
            'country' => 'MX',
            'theme' => 'mexico',
            'flag' => '/imgs/flags/mx.svg',
            'i18n_prefix' => 'home.promo.mx',
            'campaign_id' => 'home-mx-control',
            'badge' => 'Promoción México',
            'title' => 'Ordene ventas, gastos y equipo sin depender de Excel.',
            'text' => 'Una ruta clara para pasar de WhatsApp, notas sueltas y reportes tardíos a una operación centralizada.',
            'offer' => 'Diagnóstico empresarial sin costo para empresas mexicanas en crecimiento.',
            'metrics' => [
                ['value' => '4', 'label' => 'áreas críticas organizadas'],
                ['value' => '1', 'label' => 'panel para ver lo importante'],
                ['value' => '0', 'label' => 'plantillas sueltas que perseguir'],
            ],
        ],
        'CO' => [
            'country' => 'CO',
            'theme' => 'colombia',
            'flag' => '/imgs/flags/co.svg',
            'i18n_prefix' => 'home.promo.co',
            'campaign_id' => 'home-co-growth',
            'badge' => 'Promoción Colombia',
            'title' => 'Crezca con claridad: personas, procesos, productos y finanzas en orden.',
            'text' => 'Construido para empresas colombianas que quieren dejar el desorden operativo y tomar decisiones con mejores números.',
            'offer' => 'Diagnóstico inicial gratis para identificar qué área está frenando su crecimiento.',
            'metrics' => [
                ['value' => '4', 'label' => 'pilares para controlar la empresa'],
                ['value' => '30', 'label' => 'minutos para revisar su operación'],
                ['value' => '1', 'label' => 'plan de acción claro'],
            ],
        ],
        'CA' => [
            'country' => 'CA',
            'theme' => 'canada',
            'flag' => '/imgs/flags/ca.svg',
            'i18n_prefix' => 'home.promo.ca',
            'campaign_id' => 'home-ca-multilingual',
            'badge' => 'Canada multilingual launch',
            'title' => 'Run your business in English, French, Chinese or Korean.',
            'text' => 'Indice gives Canadian SMBs one operating system for teams, processes, sales, finance and guided learning.',
            'offer' => 'Launch onboarding available for multilingual teams in Canada.',
            'metrics' => [
                ['value' => '4', 'label' => 'supported language paths'],
                ['value' => '1', 'label' => 'operating dashboard'],
                ['value' => '24/7', 'label' => 'clarity across teams'],
            ],
        ],
        'US' => [
            'country' => 'US',
            'theme' => 'canada',
            'flag' => '/imgs/flags/default.svg',
            'i18n_prefix' => 'home.promo.us',
            'campaign_id' => 'home-us-clarity',
            'badge' => 'North America',
            'title' => 'Bring operations, sales and finance into one clear system.',
            'text' => 'For growing teams that need less tool fragmentation and more visibility across the business.',
            'offer' => 'Book a guided business diagnosis and see where the operation is leaking control.',
            'metrics' => [
                ['value' => '4', 'label' => 'core areas connected'],
                ['value' => '1', 'label' => 'source of truth'],
                ['value' => '0', 'label' => 'guesswork in decisions'],
            ],
        ],
        'BR' => [
            'country' => 'BR',
            'theme' => 'brasil',
            'flag' => '/imgs/flags/br.svg',
            'i18n_prefix' => 'home.promo.br',
            'campaign_id' => 'home-br-control',
            'badge' => 'Promoção Brasil',
            'title' => 'Controle sua operação, equipe e dinheiro em um só lugar.',
            'text' => 'Para empresas brasileiras que querem sair das planilhas e enxergar receitas, despesas e tarefas com clareza.',
            'offer' => 'Diagnóstico gratuito para mapear gargalos e oportunidades de controle.',
            'metrics' => [
                ['value' => '4', 'label' => 'áreas críticas organizadas'],
                ['value' => '1', 'label' => 'painel de controle'],
                ['value' => '0', 'label' => 'caos entre ferramentas'],
            ],
        ],
        'GLOBAL' => [
            'country' => 'GLOBAL',
            'theme' => 'global',
            'flag' => '/imgs/flags/default.svg',
            'i18n_prefix' => 'home.promo.global',
            'campaign_id' => 'home-global-clarity',
            'badge' => 'Claridad operacional',
            'title' => 'Toda empresa crece mejor cuando sus 4 áreas críticas están en orden.',
            'text' => 'Índice conecta personas, procesos, productos y finanzas en un sistema claro para operar y decidir mejor.',
            'offer' => 'Agenda una demo y vea qué parte de su operación necesita atención primero.',
            'metrics' => [
                ['value' => '4', 'label' => 'áreas críticas conectadas'],
                ['value' => '1', 'label' => 'sistema operativo empresarial'],
                ['value' => '+', 'label' => 'módulos para crecer'],
            ],
        ],
    ];

    return $campaigns[$country] ?? $campaigns['GLOBAL'];
}
