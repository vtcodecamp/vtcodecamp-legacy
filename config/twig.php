<?php
$cache = getenv('TWIG_CACHE');
if (false !== $cache && '/' != $cache[0]) {
    $cache = APPLICATION_ROOT . '/' . $cache;
}
return array(
    'paths'         => array(
        APPLICATION_ROOT . '/public',
    ),
    'environment'   => array(
        'cache'             => $cache,
        'debug'             => (boolean)getenv('TWIG_DEBUG'),
        'strict_variables'  => true,
    ),
);
