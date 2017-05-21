<?php

return [
    'theme' => 'monokai',
    'modes' => [
        'twig'       => [
            'extension' => 'twig',
            'name'      => 'Twig',
            'loader'    => 'twig',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/twig/twig.js',
            ],
        ],
        'html'       => [
            'extension' => 'html',
            'name'      => 'HTML',
            'loader'    => 'htmlmixed',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/xml/xml.js',
                'asset::editor-field_type/mode/javascript/javascript.js',
                'asset::editor-field_type/mode/css/css.js',
                'asset::editor-field_type/mode/vbscript/vbscript.js',
                'asset::editor-field_type/mode/htmlmixed/htmlmixed.js',
            ],
        ],
        'css'        => [
            'extension' => 'css',
            'name'      => 'CSS',
            'loader'    => 'css',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/css/css.js',
            ],
        ],
        'javascript' => [
            'extension' => 'js',
            'name'      => 'JavaScript',
            'loader'    => 'javascript',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/javascript/javascript.js',
            ],
        ],
        'markdown'   => [
            'loader'    => 'markdown',
            'extension' => 'md',
            'name'      => 'Markdown',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/xml/xml.js',
                'asset::editor-field_type/mode/markdown/markdown.js',
            ],
        ],
        'scss'       => [
            'loader'    => 'text/x-scss',
            'extension' => 'scss',
            'name'      => 'SCSS',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/css/css.js',
            ],
        ],
        'less'       => [
            'loader'    => 'text/x-less',
            'extension' => 'less',
            'name'      => 'LESS',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/css/css.js',
            ],
        ],
        'json'       => [
            'loader'    => 'application/ld+json',
            'extension' => 'json',
            'name'      => 'JSON',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/javascript/json.js',
                'asset::editor-field_type/mode/javascript/json-.js',
            ],
        ],
        'yaml'       => [
            'loader'    => 'text/x-yaml',
            'extension' => 'yaml',
            'name'      => 'YAML',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/yaml/yaml.js',
            ],
        ],
        'php'        => [
            'loader'    => 'application/x-httpd-php',
            'extension' => 'php',
            'name'      => 'PHP',
            'styles'    => [],
            'scripts'   => [
                'asset::editor-field_type/mode/htmlmixed/htmlmixed.js',
                'asset::editor-field_type/mode/xml/xml.js',
                'asset::editor-field_type/mode/javascript/javascript.js',
                'asset::editor-field_type/mode/css/css.js',
                'asset::editor-field_type/mode/clike/clike.js',
                'asset::editor-field_type/mode/php/php.js',
            ],
        ],
    ],
];
