<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class EditorFieldTypeServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class EditorFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * Register the service provider.
     *
     * @param EditorFieldType $fieldType
     */
    public function register(EditorFieldType $fieldType)
    {
        $fieldType->on('entry_saved', EditorFieldTypeCallbacks::class . '@onEntrySaved');
        $fieldType->on('entry_deleted', EditorFieldTypeCallbacks::class . '@onEntryDeleted');
        $fieldType->on('entry_translation_saved', EditorFieldTypeCallbacks::class . '@onEntryTranslationSaved');
        $fieldType->on('entry_translation_deleted', EditorFieldTypeCallbacks::class . '@onEntryTranslationDeleted');
    }
}
