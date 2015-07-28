<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Support\String;
use Illuminate\View\Factory;

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
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

    /**
     * The string parser.
     *
     * @var String
     */
    protected $string;

    /**
     * The decorated field type.
     * This is for IDE hinting.
     *
     * @var EditorFieldType
     */
    protected $object;

    /**
     * Create a new EditorFieldTypePresenter instance.
     *
     * @param Factory $view
     * @param String  $string
     * @param         $object
     */
    public function __construct(Factory $view, String $string, $object)
    {
        $this->view   = $view;
        $this->string = $string;

        parent::__construct($object);
    }

    /**
     * Return the applicable path.
     *
     * @return null|string
     */
    public function path()
    {
        if (in_array($this->object->getFileExtension(), ['html', 'twig'])) {
            return $this->object->getViewPath();
        } else {
            return $this->object->getAssetPath();
        }
    }

    /**
     * Return the rendered content.
     *
     * @return string
     */
    public function rendered()
    {
        return $this->view->make($this->path())->render();
    }

    /**
     * Return the parsed content.
     *
     * @return string
     */
    public function parsed()
    {
        return $this->string->render($this->content());
    }

    /**
     * Return the content.
     *
     * @return string
     */
    public function content()
    {
        return file_get_contents($this->object->getStoragePath());
    }

    /**
     * Return the parsed content.
     *
     * @return string
     */
    public function __toString()
    {
        if (in_array($this->object->getFileExtension(), ['html', 'twig'])) {
            return $this->rendered();
        } else {
            return $this->content();
        }
    }
}
