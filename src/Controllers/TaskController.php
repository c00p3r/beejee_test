<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Media;
use App\Models\Task;
use Pagination;

/**
 * Класс TaskController
 *
 * @package App\controllers
 */
class TaskController extends Controller
{
    public const PER_PAGE = 3;

    /**
     * Front page with task list
     */
    public function actionIndex()
    {
        $request = $this->getApp()->getRequest();
        $sortByUsername = strtoupper($request->param('username', ''));
        $sortByEmail = strtoupper($request->param('email', ''));
        $sortByStatus = strtoupper($request->param('status', ''));
        $page = $request->param('page', 1);

        $perPage = self::PER_PAGE;

        if (!$sortByUsername && !$sortByEmail && !$sortByStatus) {
            $tasks = $this->getDb()->tasks()->paged($perPage, $page);
        }
        if ($sortByUsername) {
            $tasks = $this->getDb()->tasks()->orderBy('username', $sortByUsername)->paged($perPage, $page);
        }
        if ($sortByEmail) {
            $tasks = $this->getDb()->tasks()->orderBy('email', $sortByEmail)->paged($perPage, $page);
        }
        if ($sortByStatus) {
            $tasks = $this->getDb()->tasks()->orderBy('status', $sortByStatus)->paged($perPage, $page);
        }

        $rows = $tasks->fetchAll();

        $pagesTotal = $this->getDb()->tasks()->count();
        $pagination = new Pagination($perPage, $pagesTotal);
        $pagination->page = $page;
        $pagination->url = "/tasks?username=$sortByUsername&email=$sortByEmail&status=$sortByStatus&page=";

        $canAccept = $this->isAdmin();

        return $this->render(
            'task.index', compact(
                'rows',
                'sortByUsername',
                'sortByEmail',
                'sortByStatus',
                'page',
                'pagesTotal',
                'perPage',
                'canAccept',
                'pagination'
            )
        );
    }

    /**
     * View task
     */
    public function actionView()
    {
        $request = $this->getApp()->getRequest();
        $id = $request->paramsNamed()->get('id');

        $model = $this->findModel($id);
        if (!$model) {
            $this->getApp()->action404();
        }

        $canAccept = $this->isAdmin();

        return $this->render('task.view', compact('model', 'canAccept'));
    }

    /**
     * Create task
     */
    public function actionCreate()
    {
        $request = $this->getApp()->getRequest();
        $data = $request->paramsPost()->all();

        $model = new Task($this->getDb());

        if ($model->load($data) && $model->save()) {
            $media = $this->uploadMediaForTask($model);
            if ($media) {
                return $this->redirect('@tasks');
            }

            return $this->redirect('@tasks');
        }

        $canAccept = $this->isAdmin();

        return $this->render('task.create', compact('model', 'canAccept'));
    }

    /**
     * Update task
     */
    public function actionUpdate()
    {
        if (!$this->isAdmin()) {
            $this->getApp()->action403();
        }

        $request = $this->getApp()->getRequest();
        $data = $request->paramsPost()->all();
        $id = $request->paramsNamed()->get('id');

        $model = $this->findModel($id);
        if (!$model) {
            $this->getApp()->action404();
        }

        if ($model->load($data) && $model->save()) {
            $this->uploadMediaForTask($model);
            return $this->redirect('@tasks');
        }

        $canAccept = $this->isAdmin();

        return $this->render('task.update', compact('model', 'canAccept'));
    }

    /**
     * Accept task (for admin)
     */
    public function actionAccept()
    {
        if (!$this->isAdmin()) {
            $this->getApp()->action403();
        }

        $request = $this->getApp()->getRequest();
        $id = $request->paramsNamed()->get('id');
        $model = $this->findModel($id);
        if (!$model) {
            $this->getApp()->action404();
        }

        $status = $request->paramsGet()->get('status', 1);
        $model->status = $status;
        $model->save(false);

        return $this->back();
    }

    /**
     * Delete task (for admin)
     */
    public function actionDelete()
    {
        if (!$this->isAdmin()) {
            $this->getApp()->action403();
        }

        $request = $this->getApp()->getRequest();
        $id = $request->paramsNamed()->get('id');
        $model = $this->findModel($id);
        if (!$model) {
            $this->getApp()->action404();
        }

        $model->delete();

        return $this->back();
    }

    /**
     *
     */
    public function actionUpload()
    {
        $media = $this->getApp()->getLibrary()->uploadImage('image');

        $data = [
            'url' => $media->getUrl(),
        ];
        $this->getApp()->getResponse()->json($data);
        die();
    }

    /**
     * @param int $id
     *
     * @return Task|null
     */
    protected function findModel($id)
    {
        $model = null;
        if ($id) {
            $row = $this->getDb()->tasks()->where('id', $id)->fetch();
            if ($row) {
                $model = new Task($this->getDb());
                $model->load($row->getData());
            }
        }

        return $model;
    }

    /**
     * @param Task   $model
     * @param string $name
     *
     * @return Media|null $model
     */
    protected function uploadMediaForTask(Task $model, $name = 'image')
    {
        if (isset($_FILES[$name])) {
            $media = $this->getApp()->getLibrary()->uploadImage($name);
            if ($media) {
                if ($media->hasErrors()) {
                    $model->addError('media_id', $media->getError('filename'));
                } else {
                    $model->media_id = $media->id;
                    $model->save(false);
                    return $media;
                }
            }
        }

        return null;
    }
}
