<?php namespace Anomaly\Streams\Addon\FieldType\Editor;

class EditorFieldType extends \Anomaly\Streams\Platform\Addon\FieldType\FieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'field_type.editor::input';

    public function getInputData()
    {
        $data = parent::getInputData();

        $data['lang'] = $this->pullConfig('lang', 'javascript');

        return $data;
    }
}
 