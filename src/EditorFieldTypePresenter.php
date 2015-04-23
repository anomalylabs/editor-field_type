<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class EditorFieldTypePresenter
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\EditorFieldType
 */
class EditorFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated field type.
     * This is for IDE hinting.
     *
     * @var EditorFieldType
     */
    protected $object;

    /**
     * Return the storage path.
     *
     * @return null|string
     */
    public function path()
    {
        return $this->object->getStoragePath();
    }
}
