<?php

use App\Core\View;

/**
 * @var View $this
 * @var string $content
 */


?><!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/style.css">
    <title><?= $this->getApp()->getName() ?></title>
</head>

<body>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/"><?= $this->getApp()->getName() ?></a>

        <ul class="nav justify-content-end">
            <?php if (!$this->getApp()->isGuest()) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <?= $this->getApp()->getUser()->login ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/logout" class="dropdown-item">Sign out</a>
                    </div>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a href="/login" class="nav-link">
                        <span class="btn btn-success btn-sm">Sign in</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="nav-link">
                        <span class="btn btn-primary btn-sm">Sign up</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>

    <div id="main" class="py-5">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <span class="text-muted">c00p3r.web@gmail.com</span>
    </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="/assets/js/app.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</body>
</html>

