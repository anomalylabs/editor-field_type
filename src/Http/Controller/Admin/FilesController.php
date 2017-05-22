<?php namespace Anomaly\EditorFieldType\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class FilesController
 *
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 *
 * @link          http://pyrocms.com/
 */
class FilesController extends AdminController
{

    /**
     * Return an ajax modal to choose the folder
     * to use for uploading files.
     *
     * @param  FolderRepositoryInterface
     * @return \Illuminate\View\View
     */
    public function choose(FolderRepositoryInterface $folders)
    {
        return $this->view->make(
            'anomaly.field_type.editor::ajax/choose_folder',
            [
                'folders' => $folders->all(),
            ]
        );
    }

    /**
     * Redirect to a file's URL.
     *
     * @param  FileRepositoryInterface             $files
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(FileRepositoryInterface $files)
    {
        /* @var FileInterface $file */
        if (!$file = $files->find($this->route->getParameter('id')))
        {
            abort(404);
        }

        return $this->redirect->to($file->route('view'));
    }

    /**
     * Return if a file exists or not.
     *
     * @param  FileRepositoryInterface         $files
     * @param  $folder
     * @param  $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function exists(FileRepositoryInterface $files, $folder, $name)
    {
        $success = true;
        $exists  = false;

        /* @var FolderInterface|null $folder */
        $folder = $this->dispatch(new GetFolder($folder));

        if ($folder && $file = $files->findByNameAndFolder($name, $folder))
        {
            $exists = true;
        }

        return $this->response->json(compact('success', 'exists'));
    }

    /**
     * Handle the upload.
     *
     * @param  FileUploader                    $uploader
     * @param  FolderRepositoryInterface       $folders
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(FileUploader $uploader, FolderRepositoryInterface $folders)
    {
        $error = trans('anomaly.module.files::error.generic');

        try {
            if ($file = $uploader->upload(
                $this->request->file('upload'),
                $folders->find($this->request->get('folder'))
            )
            )
            {
                return $this->response->json($file->getAttributes());
            }
        }
        catch (\Exception $e)
        {
            $error = $e->getMessage();
        }

        return $this->response->json(['error' => $error], 500);
    }

}
