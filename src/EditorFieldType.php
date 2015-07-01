<?php namespace Anomaly\EditorFieldType;

use Anomaly\EditorFieldType\Command\DeleteDirectory;
use Anomaly\EditorFieldType\Command\PutFile;
use Anomaly\EditorFieldType\Command\RenameDirectory;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

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
        'theme'  => 'monokai',
        'mode'   => 'html',
        'height' => 500
    ];

    /**
     * The mode to extension definitons.
     *
     * @var array
     */
    protected $extensions = [
        'javascript' => 'js',
        'markdown'   => 'md'
    ];

    /**
     * The application utility.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new EditorFieldType instance.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Get the storage path.
     *
     * @return null|string
     */
    public function getStoragePath()
    {
        // No entry, no path.
        if (!$this->entry) {
            return null;
        }

        // If the entry is not an EntryInterface skip it.
        if (!$this->entry instanceof EntryInterface) {
            return null;
        }

        if (!$this->entry->getTitle()) {
            return null;
        }

        $slug      = $this->entry->getStreamSlug();
        $namespace = $this->entry->getStreamNamespace();
        $directory = $this->getStorageDirectoryName();
        $file      = $this->getStorageFileName();

        return $this->application->getStoragePath("{$namespace}/{$slug}/{$directory}/{$file}");
    }

    /**
     * Get the file extension for the config mode.
     *
     * @return mixed
     */
    protected function getFileExtension()
    {
        $mode = array_get($this->getConfig(), 'mode');

        return array_get($this->extensions, $mode, $mode);
    }

    /**
     * Get the application storage page.
     *
     * @return string
     */
    public function getAppStoragePath()
    {
        return str_replace(base_path(), '', $this->getStoragePath());
    }

    /**
     * Get the storage directory name.
     *
     * @return string
     */
    protected function getStorageDirectoryName()
    {
        return str_slug($this->entry->getTitle() . '_' . $this->entry->getId(), '_');
    }

    /**
     * Get the storage file name.
     *
     * @return string
     */
    protected function getStorageFileName()
    {
        return $this->getField() . '.' . $this->getFileExtension();
    }

    /**
     * Fired after an entry is saved.
     */
    public function onEntrySaved()
    {
        $this->dispatch(new PutFile($this));
    }

    /**
     * Fired after an entry is deleted.
     */
    public function onEntryDeleted()
    {
        $this->dispatch(new DeleteDirectory($this));
    }

    /**
     * Fired after an entry is deleted.
     */
    public function onEntryUpdated()
    {
        $this->dispatch(new RenameDirectory($this));
    }
}
