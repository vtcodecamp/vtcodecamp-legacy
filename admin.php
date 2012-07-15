#!/usr/bin/php -q
<?php
/* @var $silexApp \Silex\Application */
$silexApp = require __DIR__ . '/app.php';

use Cilex\Application,
    VtCodeCamp\Version,
    VtCodeCamp\Admin\Commands\CompileTwigTemplates;

$cilexApp = new Application('Vermont Code Camp Admin', Version::VERSION);
$cilexApp->command(new CompileTwigTemplates($silexApp));
$cilexApp->run();
