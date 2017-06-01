<?php

use Illuminate\Contracts\Config\Repository;

return [
    'theme'         => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'default_value' => 'mdo',
            'options'       => function ()
            {
                $themes = glob(dirname(__DIR__) . '/css/codemirror/theme/*');

                $names = array_map(function ($file)
                {
                    return str_replace('.css', '', basename($file));
                }, $themes);

                return array_combine($names, $names);
            },
        ],
    ],
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
    'default_value' => [
        'type' => 'anomaly.field_type.textarea',
    ],
    'height'        => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'default_value' => 200,
            'min'           => 50,
            'step'          => 25,
        ],
    ],
    'word_wrap'     => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options'       => [
                'yes' => 'streams::misc.yes',
                'no'  => 'streams::misc.no',
            ],
            'default_value' => 'yes',
        ],
    ],

];
