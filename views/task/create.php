<?php

use App\Core\View;
use App\Models\Task;

/**
 * @var View $this
 * @var Task $model
 * @var bool $canAccept
 */
?>
<h1>New task</h1>

<?= $this->alertModelErrors($model) ?>
<!-- Modal -->
<div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="preview-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <img class="card-img-top" src="<?= $model->getImageUrl() ?>" alt="task image">
                    <div class="card-body">
                        <p class="card-text"></p>
                    </div>
                    <div class="card-footer text-muted">
                        Author: <span class="username"></span> &lt;<i class="email"></i>&gt;
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="preview-save-btn" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<form id="create-task-form" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="username" class="col-sm-4 col-form-label">Username</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="username" name="username" value="<?= $this->getApp()->getUser()->login ?>"
                   placeholder="Имя пользователя">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="email" name="email" value="<?= $model->email ?>"
                   placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="content" class="col-sm-4 col-form-label">Description</label>
        <div class="col-sm-8">
            <textarea id="content" name="content" class="form-control" rows="5"><?= $model->content ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="image" class="col-sm-4 col-form-label">Picture</label>
        <div class="col-sm-8">
            <input type="file" id="image" name="image" class="form-control"/>
        </div>
    </div>
    <?php if ($canAccept) : ?>
        <div class="form-group row">
            <label for="status" class="col-sm-4 col-form-label">Status</label>
            <div class="col-sm-8">
                <select id="status" name="status" class="form-control">
                    <option value="1" <?= $model->status == 1 ? 'selected' : '' ?>>Done</option>
                    <option value="0"<?= $model->status != 1 ? 'selected' : '' ?>>Pending</option>
                </select>
            </div>
        </div>
    <?php endif ?>
    <div class="form-group">
        <div class="float-right">
            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#preview-modal">
                <i class="fa fa-search" aria-hidden="true"></i> Preview
            </button>
        </div>
        <div class="float-left">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="#" onclick="window.history.back()" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</form>
