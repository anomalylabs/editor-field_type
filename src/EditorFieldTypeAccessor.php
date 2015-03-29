<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Filesystem\Filesystem;

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

    protected $files;

    protected $application;

    public function __construct(FieldType $fieldType, Application $application, Filesystem $files)
    {
        $this->files       = $files;
        $this->application = $application;

        parent::__construct($fieldType);
    }

    /**
     * Set the value on the entry.
     *
     * @param EloquentModel $entry
     * @param               $value
     */
    public function set(EloquentModel $entry, $value)
    {
        if ($entry instanceof EntryInterface) {

            $path = $this->getStoragePath($entry);

            if (!is_dir(dirname($path))) {
                $this->files->makeDirectory(dirname($path), 0777, true, true);
            }

            $this->files->put($path, $value);
        }

        parent::set($entry, $value);
    }

    /**
     * Get the value off the entry.
     *
     * @param EloquentModel $entry
     * @return mixed
     */
    public function get(EloquentModel $entry)
    {
        if ($entry instanceof EntryInterface) {

            $path = $this->getStoragePath($entry);

            if (file_exists($path) && $value = $this->files->get($path)) {
                return $value;
            }
        }

        return parent::get($entry);
    }

    /**
     * Get the storage path.
     *
     * @param $entry
     */
    protected function getStoragePath(EntryInterface $entry)
    {
        $slug      = $entry->getStreamSlug();
        $namespace = $entry->getStreamNamespace();
        $folder    = str_slug($entry->getTitle(), '_');
        $file      = $this->fieldType->getField() . '.' . array_get($this->fieldType->getConfig(), 'mode');

        return $this->application->getStoragePath("{$namespace}/{$slug}/{$folder}/{$file}");
    }
}
