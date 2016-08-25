<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Filesystem\Filesystem;

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
     */
    public function register()
    {
        $target = $this->app->make('Anomaly\Streams\Platform\Application\Application')->getAssetsPath(
            'editor-field_type'
        );

        /*
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