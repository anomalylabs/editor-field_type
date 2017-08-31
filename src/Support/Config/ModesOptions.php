<?php namespace Anomaly\EditorFieldType\Support\Config;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Contracts\Config\Repository;

class ModesOptions
{

    /**
     * Handle the select options.
     *
     * @param      SelectFieldType  $fieldType  The field type
     * @param      Repository       $config     The configuration
     */
    public function handle(SelectFieldType $fieldType, Repository $config)
    {
        $fieldType->setOptions(array_combine(
            array_keys($config->get('anomaly.field_type.editor::editor.modes')),
            array_map(
                function ($mode) {
                    return $mode['name'];
                },
                $config->get('anomaly.field_type.editor::editor.modes')
            )
        ));
    }
}
