<?php

declare(strict_types=1);

use PhpCsFixer\Config;

require __DIR__ . '/main.php';

array_unshift($rules, ['@PHP81Migration' => true]);

return (new Config())
    ->setFinder($finder)
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules($rules);
