<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['config', 'fixtures', 'src']);

$config = PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_var_without_name' => false,
    ]);

return $config;