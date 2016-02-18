<?php namespace Anomaly\EditorFieldType;

use Anomaly\EditorFieldType\Command\RenameDirectory;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class EditorFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\EditorFieldType
 */
class EditorFieldType extends FieldType
{

    /**
     * The database column type.
     *
     * @var string
     */
    protected $columnType = 'text';

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
        'mode'   => 'twig',
        'height' => 500
    ];

    /**
     * The mode to extension definitions.
     *
     * @var array
     */
    protected $extensions = [
        'javascript' => 'js',
        'markdown'   => 'md',
        'sass'       => 'scss'
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
     * Get the file path.
     *
     * @return null|string
     */
    public function getFilePath()
    {
        if ($this->entry === null || !is_object($this->entry) || !$this->entry->getId()) {
            return null;
        }

        $slug      = $this->entry->getStreamSlug();
        $namespace = $this->entry->getStreamNamespace();
        $directory = $this->entry->getEntryId();
        $file      = $this->getFileName();

        return "{$namespace}/{$slug}/{$directory}/{$file}";
    }

    /**
     * Get the storage path.
     *
     * @return null|string
     */
    public function getStoragePath()
    {
        if (!$path = $this->getFilePath()) {
            return null;
        }

        return $this->application->getStoragePath($path);
    }

    /**
     * Get the view path.
     *
     * @return string
     */
    public function getViewPath()
    {
        if (!$path = $this->getFilePath()) {
            return null;
        }

        return 'storage::' . str_replace(['.html', '.twig'], '', $path);
    }

    /**
     * Get the asset path.
     *
     * @return string
     */
    public function getAssetPath()
    {
        if (!$path = $this->getFilePath()) {
            return null;
        }

        return 'storage::' . $path;
    }

    /**
     * Get the storage file name.
     *
     * @return string
     */
    protected function getFileName()
    {
        return trim($this->getField() . '_' . $this->getLocale(), '_') . '.' . $this->getFileExtension();
    }

    /**
     * Get the file extension for the config mode.
     *
     * @return mixed
     */
    public function getFileExtension()
    {
        $mode = array_get($this->getConfig(), 'mode');

        return array_get($this->extensions, $mode, $mode);
    }
}
