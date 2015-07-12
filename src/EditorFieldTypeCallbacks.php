<?php namespace Anomaly\EditorFieldType;

use Anomaly\EditorFieldType\Command\DeleteDirectory;
use Anomaly\EditorFieldType\Command\PutFile;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class EditorFieldTypeCallbacks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\EditorFieldType
 */
class EditorFieldTypeCallbacks
{

    use DispatchesCommands;

    /**
     * Fired after an entry is saved.
     *
     * @param EditorFieldType $fieldType
     */
    public function onEntrySaved(EditorFieldType $fieldType)
    {
        if (!$fieldType->getLocale()) {
            $this->dispatch(new PutFile($fieldType));
        }
    }

    /**
     * Fired after an entry translation is saved.
     *
     * @param EditorFieldType $fieldType
     */
    public function onEntryTranslationSaved(EditorFieldType $fieldType)
    {
        $this->dispatch(new PutFile($fieldType));
    }

    /**
     * Fired after an entry is deleted.
     *
     * @param EditorFieldType $fieldType
     */
    public function onEntryDeleted(EditorFieldType $fieldType)
    {
        if (!$fieldType->getLocale()) {
            $this->dispatch(new DeleteDirectory($fieldType));
        }
    }

    /**
     * Fired after an entry translation is deleted.
     *
     * @param EditorFieldType $fieldType
     */
    public function onEntryTranslationDeleted(EditorFieldType $fieldType)
    {
        $this->dispatch(new DeleteDirectory($fieldType));
    }
}
