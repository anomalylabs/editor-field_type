<?php namespace Anomaly\EditorFieldType\Support\Config;

use Anomaly\SelectFieldType\SelectFieldType;


/**
 * Class ModeHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ModeHandler
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param Repository $config
     */
    public function handle(SelectFieldType $fieldType, Repository $config)
    {
        $fieldType->setOptions(
            array_combine(
                array_keys(config('anomaly.field_type.editor::editor.modes')),
                array_map(
                    function ($mode) {
                        return $mode['name'];
                    },
                    config('anomaly.field_type.editor::editor.modes')
                )
            )
        );
    }
}
