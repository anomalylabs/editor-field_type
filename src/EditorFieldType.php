<?php namespace Anomaly\EditorFieldType;

use Anomaly\EditorFieldType\Command\RenameDirectory;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Application\Application;

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
     * Get the file path.
     *
     * @return string
     */
    public function getFilePath()
    {
        $slug      = $this->entry->getStreamSlug();
        $namespace = $this->entry->getStreamNamespace();
        $directory = $this->entry->getEntryId();
        $file      = $this->getFileName();

        return "{$namespace}/types/{$slug}/{$directory}/{$file}";
    }

    /**
     * Get the storage path.
     *
     * @return string
     */
    public function getStoragePath()
    {
        return $this->application->getStoragePath($this->getFilePath());
    }

    /**
     * Get the view path.
     *
     * @return string
     */
    public function getViewPath()
    {
        return 'storage::' . str_replace(['.html', '.twig'], '', $this->getFilePath());
    }

    /**
     * Get the asset path.
     *
     * @return string
     */
    public function getAssetPath()
    {
        return 'storage::' . $this->getFilePath();
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
