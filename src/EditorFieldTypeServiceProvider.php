<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Filesystem\Filesystem;

/**
 * Class EditorFieldTypeServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\EditorFieldType
 */
class EditorFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $target = $this->app->make('Anomaly\Streams\Platform\Application\Application')->getAssetsPath(
            'editor-field_type'
        );

        /**
         * If the Ace assets don't exist then
         * copy them all over there.
         */
        if (!is_dir($target)) {

            /* @var Filesystem $files */
            $files = $this->app->make('files');

            $files->copyDirectory($this->addon->getPath('resources/js/ace'), $target);
        }
    }
}