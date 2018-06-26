<?php

return [
    'index' => [
        'path'       => '/',
        'method'     => 'GET',
        'controller' => 'TaskController',
        'action'     => 'index',
    ],
    'home' => [
        'path'       => '/home',
        'method'     => 'GET',
        'controller' => 'TaskController',
        'action'     => 'index',
    ],
    'registerForm' => [
        'path'       => '/register',
        'method'     => 'GET',
        'controller' => 'UserController',
        'action'     => 'register',
    ],
    'userRegister' => [
        'path'       => '/register',
        'method'     => 'POST',
        'controller' => 'UserController',
        'action'     => 'register',
    ],
    'loginForm' => [
        'path'       => '/login',
        'method'     => 'GET',
        'controller' => 'UserController',
        'action'     => 'login',
    ],
    'userLogin' => [
        'path'       => '/login',
        'method'     => 'POST',
        'controller' => 'UserController',
        'action'     => 'login',
    ],
    'userLogout' => [
        'path'       => '/logout',
        'method'     => 'GET',
        'controller' => 'UserController',
        'action'     => 'logout',
    ],
    'tasks' => [
        'path'       => '/tasks',
        'method'     => 'GET',
        'controller' => 'TaskController',
        'action'     => 'index',
    ],
    'viewTask' => [
        'path'       => '/task/[:id]',
        'method'     => 'GET',
        'controller' => 'TaskController',
        'action'     => 'view',
    ],
    'taskCreateForm' => [
        'path'       => '/tasks/create',
        'method'     => 'GET',
        'controller' => 'TaskController',
        'action'     => 'create',
    ],
    'taskCreate' => [
        'path'       => '/tasks/create',
        'method'     => 'POST',
        'controller' => 'TaskController',
        'action'     => 'create',
    ],
    'taskUpdateForm' => [
        'path'       => '/task/[:id]/update',
        'method'     => 'GET',
        'controller' => 'TaskController',
        'action'     => 'update',
    ],
    'taskUpdate' => [
        'path'       => '/task/[:id]/update',
        'method'     => 'POST',
        'controller' => 'TaskController',
        'action'     => 'update',
    ],
    'taskAccept' => [
        'path'       => '/task/[:id]/accept',
        'method'     => 'GET',
        'controller' => 'TaskController',
        'action'     => 'accept',
    ],
    'taskDelete' => [
        'path'       => '/task/[:id]/delete',
        'method'     => 'GET',
        'controller' => 'TaskController',
        'action'     => 'delete',
    ],
    'imageUpload' => [
        'path'       => '/image/upload',
        'method'     => 'POST',
        'controller' => 'TaskController',
        'action'     => 'upload',
    ],
];