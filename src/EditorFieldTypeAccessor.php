<?php namespace Anomaly\EditorFieldType;

use Anomaly\EditorFieldType\Command\GetFile;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class EditorFieldTypeAccessor
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\EditorFieldType
 */
class EditorFieldTypeAccessor extends FieldTypeAccessor
{

    use DispatchesCommands;

    /**
     * Get the value off the entry.
     *
     * @param EloquentModel $entry
     * @return string
     */
    public function get(EloquentModel $entry)
    {
        return $this->dispatch(new GetFile($this->fieldType));
    }
}
