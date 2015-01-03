<?php namespace Anomaly\EditorFieldType;

class EditorFieldType extends \Anomaly\Streams\Platform\Addon\FieldType\FieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.editor::input';

    public function getInputData()
    {
        $data = parent::getInputData();

        $data['lang'] = $this->pullConfig('lang', 'javascript');

        return $data;
    }
}
 