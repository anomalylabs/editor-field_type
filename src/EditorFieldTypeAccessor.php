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
     * The file system.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The field type.
     *
     * @var EditorFieldType
     */
    protected $fieldType;

    /**
     * The application utility.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new EditorFieldTypeAccessor instance.
     *
     * @param FieldType   $fieldType
     * @param Application $application
     * @param Filesystem  $files
     */
    public function __construct(FieldType $fieldType, Application $application, Filesystem $files)
    {
        $this->files       = $files;
        $this->application = $application;

        parent::__construct($fieldType);
    }

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
