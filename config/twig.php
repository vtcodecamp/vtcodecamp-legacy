<?php
return array(
    'paths'         => array(
        APPLICATION_ROOT . '/public',
    ),
    //TODO: Make cache path absolute if it's relative
    'environment'   => array(
        'cache'             => getenv('TWIG_CACHE'),
        'debug'             => (boolean)getenv('TWIG_DEBUG'),
        'strict_variables'  => true,
    ),
    'templates'     => array(
        'index.html',
        'attend/index.html',
        'speak/index.html',
        'sponsor/index.html',
    ),
);
