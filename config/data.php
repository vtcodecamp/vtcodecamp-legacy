<?php
$cache = getenv('DATA_CACHE');
if (false !== $cache && '/' != $cache[0]) {
    $cache = APPLICATION_ROOT . '/' . $cache;
}
return array(
    'cache'             => $cache,
);
