#!/usr/bin/php -q
<?php
defined('APPLICATION_ROOT')
    || define('APPLICATION_ROOT', realpath(dirname(__FILE__) . '/../'));
require APPLICATION_ROOT . '/vendor/autoload.php';

use Silex\Application,
    Silex\Provider\TwigServiceProvider,
    Silex\Provider\UrlGeneratorServiceProvider,
    Silex\Provider\SymfonyBridgesServiceProvider;

$silexConfig = include APPLICATION_ROOT . '/config/silex.php';
$app = new Application();
$app['debug'] = $silexConfig['debug'];

$twigConfig = include APPLICATION_ROOT . '/config/twig.php';
$app->register(new TwigServiceProvider(), array(
    'twig.path'       => $twigConfig['paths'],
    'twig.options'    => $twigConfig['environment'],
));

$app->register(new UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\SymfonyBridgesServiceProvider());

/* @var $twig Twig_Environment */
$twig = $app['twig'];

foreach ($twigConfig['paths'] as $path) {
    echo 'Path: ' . $path . PHP_EOL;
}
echo 'Cache: '. $twigConfig['environment']['cache'] . PHP_EOL;
echo 'Debug: '. $twigConfig['environment']['debug'] . PHP_EOL;

foreach ($twigConfig['paths'] as $path) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
    while ($iterator->valid()) {
        if (!$iterator->isDot() && !$iterator->isDir()) {
            $twig->loadTemplate($iterator->getSubPathName());
        }
        $iterator->next();
    }
}

exit(0);
