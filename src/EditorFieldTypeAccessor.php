<?php namespace Anomaly\EditorFieldType;

use Anomaly\EditorFieldType\Command\GetFile;
use Anomaly\EditorFieldType\Command\PutFile;
use Anomaly\EditorFieldType\Command\SyncFile;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;
use Illuminate\Foundation\Bus\DispatchesJobs;

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

    use DispatchesJobs;

    /**
     * The field type instance.
     * This is for IDE hinting.
     *
     * @var EditorFieldType
     */
    protected $fieldType;

    /**
     * Get the value off the entry.
     *
     * @return string
     */
    public function get()
    {
        if (!file_exists($this->fieldType->getStoragePath())) {
            $this->dispatch(new PutFile($this->fieldType));
        }

        if (config('app.debug')) {
            return $this->dispatch(new SyncFile($this->fieldType));
        }

        return $this->dispatch(new GetFile($this->fieldType));
    }
}
