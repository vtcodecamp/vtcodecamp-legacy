<?php
defined('APPLICATION_ROOT')
    || define('APPLICATION_ROOT', realpath(dirname(__FILE__) . '/../'));
require APPLICATION_ROOT . '/vendor/.composer/autoload.php';

$slimConfig = include APPLICATION_ROOT . '/config/slim.php';
$app = new Slim($slimConfig);

$twigConfig = include APPLICATION_ROOT . '/config/twig.php';
$loader = new Twig_Loader_Filesystem($twigConfig['paths']);
$twig = new Twig_Environment($loader, $twigConfig['environment']);

$app->get('/(:id)/', function ($id = 'index') use ($app, $twig)  {
    try {
        $templateName = 'pages/' . $id . '.html';
        $template = $twig->loadTemplate($templateName);
        $app->lastModified(filemtime($twig->getCacheFilename($templateName)));
    } catch (Twig_Error_Loader $ex) {
        $app->pass();
    }
    $content = $template->render(array(
    ));
    $app->etag(md5($content));
    echo $content;
});

$app->notFound(function () use ($app, $twig) {
    $template = $twig->loadTemplate('error/404.html');
    $content = $template->render(array(
    ));
    echo $content;
});

$app->error(function () use ($app, $twig) {
    $template = $twig->loadTemplate('error/500.html');
    $content = $template->render(array(
    ));
    echo $content;
});

$app->run();
