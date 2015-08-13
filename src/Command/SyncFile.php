<?php namespace Anomaly\EditorFieldType\Command;

use Anomaly\EditorFieldType\EditorFieldType;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SyncFile
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\EditorFieldType\Command
 */
class SyncFile implements SelfHandling
{

    use DispatchesJobs;

    /**
     * The editor field type instance.
     *
     * @var EditorFieldType
     */
    protected $fieldType;

    /**
     * Create a new SyncFile instance.
     *
     * @param EditorFieldType $fieldType
     */
    public function __construct(EditorFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Handle the command.
     *
     * @param EntryRepositoryInterface $repository
     * @return string
     */
    public function handle(EntryRepositoryInterface $repository)
    {
        $path  = $this->fieldType->getStoragePath();
        $entry = $this->fieldType->getEntry();

        $content = $this->dispatch(new GetFile($this->fieldType));

        if (md5($content) == md5($entry->getRawAttribute($this->fieldType->getField()))) {
            return $content;
        }

        if (filemtime($path) > $entry->lastModified()->timestamp) {
            $repository->save($entry->setRawAttribute($this->fieldType->getField(), $content));
        }

        return $content;
    }
}
