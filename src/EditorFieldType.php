<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class EditorFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\EditorFieldType
 */
class EditorFieldType extends FieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.editor::input';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'theme'  => 'chrome',
        'mode'   => 'html',
        'height' => 500
    ];

}
