<?php

return [
    'themes' => array_map(
        function ($item)
        {
            return str_replace(
                '.css',
                '',
                array_get(array_reverse(explode('/', $item)), 0)
            );
        },
        glob(__DIR__.'/../js/theme/*'
    )),

    'modes'  => [
        'css'        => [
            'extension' => 'css',
            'name'      => 'CSS',
        ],
        'javascript' => [
            'extension' => 'javascript',
            'name'      => 'JavaScript',
        ],
        'markdown'   => [
            'extension' => 'markdown',
            'name'      => 'Markdown',
        ],
        'php'        => [
            'extension' => 'php',
            'name'      => 'PHP',
        ],
        'pug'        => [
            'extension' => 'pug',
            'name'      => 'Pug',
        ],
        'sass'       => [
            'extension' => 'sass',
            'name'      => 'SASS',
        ],
        'shell'      => [
            'extension' => 'shell',
            'name'      => 'Shell',
        ],
        'stylus'     => [
            'extension' => 'stylus',
            'name'      => 'Stylus',
        ],
        'twig'       => [
            'extension' => 'twig',
            'name'      => 'Twig',
        ],
        'vue'        => [
            'extension' => 'vue',
            'name'      => 'Vue',
        ],
        'xml'        => [
            'extension' => 'xml',
            'name'      => 'XML',
        ],
        'yaml'       => [
            'extension' => 'yaml',
            'name'      => 'YAML',
        ],
    ],
];
