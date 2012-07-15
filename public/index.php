<?php
defined('APPLICATION_ROOT')
    || define('APPLICATION_ROOT', realpath(dirname(__FILE__) . '/../'));
require APPLICATION_ROOT . '/vendor/autoload.php';

use Silex\Application,
    Silex\Provider\TwigServiceProvider,
    Silex\Provider\UrlGeneratorServiceProvider,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpKernel\Exception\HttpException;

$silexConfig = include APPLICATION_ROOT . '/config/silex.php';
$app = new Application();
$app['debug'] = $silexConfig['debug'];

$twigConfig = include APPLICATION_ROOT . '/config/twig.php';
$app->register(new TwigServiceProvider(), array(
    'twig.path'       => $twigConfig['paths'],
    'twig.options'    => $twigConfig['environment'],
));

$app->register(new UrlGeneratorServiceProvider());

$app->after(function (Request $request, Response $response) {
    if (!$request->isMethod('GET') && $response->isOk()) {
        return;
    }
    $response->setEtag(md5($response->getContent()));
    //TODO: Make configurable
    $maxAge = 60;
    $maxAgeDateInterval = new \DateInterval('PT' . $maxAge . 'S');
    $expires = new \DateTime();
    $expires->add($maxAgeDateInterval);
    $response->setMaxAge($maxAge);
    $response->setSharedMaxAge($maxAge);
    $response->setPublic();
    $response->headers->addCacheControlDirective('must-revalidate');
    $response->setExpires($expires);
    $response->setVary(array('Accept', 'Accept-Encoding', 'Accept-Language', 'Cookie'));
    if ($response->isNotModified($request)) {
        $response->setNotModified();
    }
});

$app->get('/{id}', function (Application $app, Request $request, $id) {
    $id = rtrim($id, '/');
    /* @var $twig Twig_Environment */
    $twig = $app['twig'];
    $response = new Response();
    try {
        $templateName = 'pages/' . $id . '.html';
        $template = $twig->loadTemplate($templateName);
        $lastModified = new \DateTime('@' . filemtime($twig->getCacheFilename($templateName)));
        $response->setLastModified($lastModified);
    } catch (Twig_Error_Loader $ex) {
        $app->abort(404);
    }
    $content = $template->render(array(
    ));
    $response->setContent($content);
    return $response;
})->assert('id', '.+')->value('id', 'index')->bind('page');

$app->error(function (\Exception $ex, $code) use ($app) {
    if ($app['debug'] && 500 == $code) {
        return;
    }
    $headers = array();
    if ($ex instanceof HttpException) {
        /* @var $httpException /Symfony\Component\HttpKernel\Exception\HttpException */
        $httpException = $ex;
        $headers = $httpException->getHeaders();
    }
    /* @var $twig Twig_Environment */
    $twig = $app['twig'];
    $template = null;
    try {
        $template = $twig->loadTemplate('error/' . $code . '.html');
    } catch (Twig_Error_Loader $ex) {
        $template = $twig->loadTemplate('error/500.html');
    }
    $content = $template->render(array(
        'headers'   => $headers,
    ));
    return new Response($content, $code, $headers);
});

$app->run();
