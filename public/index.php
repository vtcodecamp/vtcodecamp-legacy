<?php
defined('APPLICATION_ROOT')
    || define('APPLICATION_ROOT', realpath(dirname(__FILE__) . '/../'));
require APPLICATION_ROOT . '/vendor/.composer/autoload.php';

$twigConfig = include APPLICATION_ROOT . '/config/twig.php';

$loader = new Twig_Loader_Filesystem($twigConfig['paths']);
$twig = new Twig_Environment($loader, $twigConfig['environment']);

$template = $twig->loadTemplate('index.html');

echo $template->render(array(
));
