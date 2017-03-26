<?php

use Illuminate\Contracts\Config\Repository;

return [
    'mode'          => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => function (Repository $config)
            {
                return array_combine(
                    array_keys($config->get('anomaly.field_type.editor::editor.modes')),
                    array_map(
                        function ($mode)
                        {
                            return $mode['name'];
                        },
                        $config->get('anomaly.field_type.editor::editor.modes')
                    )
                );
            },
        ],
    ],
    'theme'         => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => function (Repository $config)
            {
                return array_combine(
                    $config->get('anomaly.field_type.editor::editor.themes'),
                    array_map(
                        function ($theme)
                        {
                            return $theme;
                        },
                        $config->get('anomaly.field_type.editor::editor.themes')
                    )
                );
            },

        ],
    ],
    'default_value' => [
        'type' => 'anomaly.field_type.textarea',
    ],
    'height'        => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 500,
            'min'           => 200,
            'step'          => 50,
        ],
    ],
    'font_size'     => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 16,
            'min'           => 10,
            'max'           => 24,
        ],
    ],
    'tab_size'      => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'default_value' => 2,
            'min'           => 2,
            'max'           => 8,
            'step'          => 2,
        ],
    ],
    'tab_type'      => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options'       => [
                'spaces' => 'Spaces',
                'tabs'   => 'Tabs',
            ],
            'default_value' => 'spaces',
        ],
    ],
    'word_wrap'     => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options'       => [
                'yes' => 'streams::misc.yes',
                'no'  => 'streams::misc.no',
            ],
            'default_value' => 'yes',
        ],
    ],

];
