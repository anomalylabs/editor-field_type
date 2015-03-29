<?php namespace Anomaly\EditorFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Config\Repository;
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
        /* @var Filesystem $files */
        /* @var Repository $config */
        $config = $this->app->make('config');

        $target = $this->app->make('Anomaly\Streams\Platform\Application\Application')->getAssetsPath('ace');

        if ($config->get('app.debug') && !is_dir($target)) {

            $files = $this->app->make('files');

            $files->copyDirectory($this->addon->getPath('resources/js/ace'), $target);
        }
    }
}
