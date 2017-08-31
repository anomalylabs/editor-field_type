<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class EditorFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
        'height' => 75,
    ];

    /**
     * The storage handler.
     *
     * @var null|EditorFieldTypeStorage
     */
    protected $storage = null;

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
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $config['loader'] = config('anomaly.field_type.editor::editor.modes.' . $config['mode'] . '.loader');

        if (array_get($config, 'word_wrap')) {
            $config['word_wrap'] = filter_var(array_get($config, 'word_wrap'), FILTER_VALIDATE_BOOLEAN);
        }

        return $config;
    }

    /**
     * Get the file path.
     *
     * @return null|string
     */
    public function getFilePath()
    {
        return $this->storage()->path();
    }

    /**
     * Get the storage path.
     *
     * @return null|string
     */
    public function getStoragePath()
    {
        return $this->storage()->storagePath();
    }

    /**
     * Get the view path.
     *
     * @return string
     */
    public function getViewPath()
    {
        return $this->storage()->viewPath();
    }

    /**
     * Get the asset path.
     *
     * @return string
     */
    public function getAssetPath()
    {
        return $this->storage()->assetPath();
    }

    /**
     * Get the storage file name.
     *
     * @return string
     */
    protected function getFileName()
    {
        return $this->storage()->filename();
    }

    /**
     * Return the file extension.
     *
     * @return mixed
     */
    public function extension()
    {
        return $this->mode()['extension'];
    }

    /**
     * Return the editor mode.
     *
     * @return mixed
     */
    public function mode()
    {
        $mode = array_get($this->getConfig(), 'mode');

        return config('anomaly.field_type.editor::editor.modes.' . $mode);
    }

    /**
     * Return the editor theme.
     *
     * @return mixed
     */
    public function theme()
    {
        return config('anomaly.field_type.editor::editor.theme');
    }

    /**
     * Return the storage class.
     */
    public function storage()
    {
        if (!$this->storage) {
            $this->storage = app()->make(
                $this->config('storage', EditorFieldTypeStorage::class),
                ['fieldType' => $this]
            );
        }

        return $this->storage;
    }
}
