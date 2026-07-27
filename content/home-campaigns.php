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
            'badge' => 'Sistema operativo empresarial',
            'title' => 'Opera tu negocio con claridad.',
            'text' => 'Conecta equipo, ventas, inventario y finanzas para que la operación no dependa de ti.',
            'offer' => 'Ve lo que pasa. Decide qué hacer. Crece con control.',
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
            'badge' => 'Sistema operativo empresarial',
            'title' => 'Opera tu negocio con claridad.',
            'text' => 'Formaliza responsabilidades y conecta personas, procesos, inventario y finanzas para crecer con estructura.',
            'offer' => 'Ve lo que pasa. Decide qué hacer. Crece con control.',
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
            'badge' => 'Business operating system',
            'title' => 'Run your business with clarity.',
            'text' => 'Connect teams, locations, inventory and finance in one system designed for growing businesses.',
            'offer' => 'See what is happening. Decide what to do. Grow with control.',
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
            'badge' => 'Business operating system',
            'title' => 'Run your business with clarity.',
            'text' => 'Replace disconnected tools and manual work with one clear system for operations, inventory, people and finance.',
            'offer' => 'See what is happening. Decide what to do. Grow with control.',
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
            'badge' => 'Sistema operacional empresarial',
            'title' => 'Gerencie sua empresa com clareza.',
            'text' => 'Conecte pessoas, processos, estoque e finanças para crescer com controle e produtividade.',
            'offer' => 'Veja o que acontece. Decida o que fazer. Cresça com controle.',
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
            'badge' => 'Sistema operativo empresarial',
            'title' => 'Opera tu negocio con claridad.',
            'text' => 'Personas, procesos, productos y finanzas conectados en un sistema que también te ayuda a operar mejor.',
            'offer' => 'Ve lo que pasa. Decide qué hacer. Crece con control.',
            'metrics' => [
                ['value' => '4', 'label' => 'áreas críticas conectadas'],
                ['value' => '1', 'label' => 'sistema operativo empresarial'],
                ['value' => '+', 'label' => 'módulos para crecer'],
            ],
        ],
    ];

    return $campaigns[$country] ?? $campaigns['GLOBAL'];
}
