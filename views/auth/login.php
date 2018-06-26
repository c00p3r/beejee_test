<?php

use App\Core\View;
use App\Models\LoginForm;

/**
 * @var View $this
 * @var LoginForm $model
 */

?>
<h1>Sign In</h1>

<?= $this->alertModelErrors( $model ) ?>

<form method="post">
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="username" name="username" value="<?= $model->username ?>" placeholder="Username">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Go!</button>
        </div>
    </div>
</form>