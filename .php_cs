<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'no_unused_imports' => true,
        'ordered_imports' => ['sortAlgorithm' => 'length'],
        'array_syntax' => ['syntax' => 'short'],
        'fully_qualified_strict_types' => true,
        'single_quote' => true,
        'single_trait_insert_per_statement' => true,
        'ordered_class_elements' => true,
    ])
    ->setFinder($finder);
