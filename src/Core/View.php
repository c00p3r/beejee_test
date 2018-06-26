<?php

namespace App\Core;


/**
 * Class View
 *
 * @package App\base
 */
class View
{
    /**
     * @var  Application
     */
    protected $app;

    /**
     * @var string
     */
    protected $path;

    /**
     * View constructor.
     *
     * @param Application $app
     * @param string      $path
     */
    public function __construct($app, $path = ROOT . '/views/')
    {
        $this->app = $app;
        $this->path = $path;
    }

    /**
     * @param string $viewName
     * @param array  $params
     *
     * @return string
     */
    public function render($viewName, $params = [])
    {
        $viewPath = $this->path . $viewName . '.php';
        return $this->renderFile($viewPath, $params);
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @return string
     */
    public function renderFile($path, $params = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        include $path;

        return ob_get_clean();
    }

    /**
     * @param Model $model
     *
     * @return string
     */
    public function alertModelErrors(Model $model)
    {
        $errors = $model->getErrors();

        $html = '';
        foreach ($errors as $attribute => $error) {
            $html .= '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }

        return $html;
    }

    /**
     * @return Application
     */
    public function getApp()
    {
        return $this->app;
    }
}
