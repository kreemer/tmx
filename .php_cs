<?php

$header = <<<EOF
This file is part of the Tmx package.
(c) kreemer <kreemer@me.com>
For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Fixtures')
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
;

return PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setRules(array(
        '@Symfony' => true,
        'concat_space' => [
            'spacing' => 'one'
        ],
        'phpdoc_align' => ['align' => 'vertical']
    ))
    ->setFinder($finder)
;