<?php
require_once __DIR__ . '/content/module-basic-pages.php';

$module = basicModuleConfig('caja-chica');
$page_title = basicModulePageTitle($module);
$page_description = basicModulePageDescription($module);
include 'header.php';
basicModuleRenderPage($module);
include 'footer.php';
