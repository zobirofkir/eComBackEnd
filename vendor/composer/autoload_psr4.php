<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'database\\' => array($baseDir . '/migrations/databases'),
    'config\\' => array($baseDir . '/conf'),
    'Symfony\\Polyfill\\Php80\\' => array($vendorDir . '/symfony/polyfill-php80'),
    'Symfony\\Polyfill\\Mbstring\\' => array($vendorDir . '/symfony/polyfill-mbstring'),
    'Symfony\\Polyfill\\Ctype\\' => array($vendorDir . '/symfony/polyfill-ctype'),
    'Route\\' => array($baseDir . '/routes'),
    'PhpOption\\' => array($vendorDir . '/phpoption/phpoption/src/PhpOption'),
    'Model\\' => array($baseDir . '/App/Models'),
    'GrahamCampbell\\ResultType\\' => array($vendorDir . '/graham-campbell/result-type/src'),
    'Firebase\\JWT\\' => array($vendorDir . '/firebase/php-jwt/src'),
    'Dotenv\\' => array($vendorDir . '/vlucas/phpdotenv/src'),
    'Controller\\' => array($baseDir . '/App/Controllers'),
    'Auth\\' => array($baseDir . '/App/Authentication'),
);
