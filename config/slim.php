<?php
return array(
    'log.enable'            => false,
    'debug'                 => (boolean)getenv('SLIM_DEBUG'),
    'cookies.secure'        => true,
    'cookies.httponly'      => true,
    'cookies.secret_key'    => getenv('SLIM_COOKIES_SECRET_KEY'),
    'cookies.encrypt'       => true,
);
