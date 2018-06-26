<?php

use App\Core\View;
use App\Models\Task;
use LessQL\Result;

/**
 * @var View $this
 * @var Result[] $rows
 * @var string $sortByUsername
 * @var string $sortByEmail
 * @var string $sortByStatus
 * @var int $page
 * @var int $pageSize
 * @var int $pagesTotal
 * @var bool $canAccept
 * @var Pagination $pagination
 */

?>
<div class="">
    <div class="float-right">
        <a href="/tasks/create" class="btn btn-primary btn-lg">Add task</a>
    </div>

    <h1>Task list</h1>
</div>

<div class="modal fade" id="view-modal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task <span class="status"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <img class="card-img-top" src="" alt="task image">
                    <div class="card-body">
                        <p class="card-text"></p>
                    </div>
                    <div class="card-footer text-muted">
                        Author: <span class="username"></span> &lt;<i class="email"></i>&gt;
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Image</th>
        <th>
            User
            <?php if (!$sortByUsername) : ?>
                <a class="text-success"
                   href="/tasks?username=ASC&email=<?= $sortByEmail ?>&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                </a>
                <a class="text-success"
                   href="/tasks?username=DESC&email=<?= $sortByEmail ?>&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                </a>
            <?php elseif ($sortByUsername == 'ASC') : ?>
                <span>&uarr;</span>
                <a class="text-success"
                   href="/tasks?username=DESC&email=<?= $sortByEmail ?>&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                </a>
                <a class="text-danger"
                   href="/tasks?username=&email=<?= $sortByEmail ?>&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                </a>
            <?php else : ?>
                <span>&darr;</span>
                <a class="text-success"
                   href="/tasks?username=ASC&email=<?= $sortByEmail ?>&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                </a>
                <a class="text-danger"
                   href="/tasks?username=&email=<?= $sortByEmail ?>&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                </a>
            <?php endif ?>
        </th>
        <th>
            Email
            <?php if (!$sortByEmail) : ?>
                <a class="text-success"
                   href="/tasks?username=<?= $sortByUsername ?>&email=ASC&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                </a>
                <a class="text-success"
                   href="/tasks?username=<?= $sortByUsername ?>&email=DESC&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                </a>
            <?php elseif ($sortByEmail == 'ASC') : ?>
                <span>&uarr;</span>
                <a class="text-success"
                   href="/tasks?username=<?= $sortByUsername ?>&email=DESC&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                </a>
                <a class="text-danger"
                   href="/tasks?username=<?= $sortByUsername ?>&email=&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                </a>
            <?php else : ?>
                <span>&darr;</span>
                <a class="text-success"
                   href="/tasks?username=<?= $sortByUsername ?>&email=ASC&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                </a>
                <a class="text-danger"
                   href="/tasks?username=<?= $sortByUsername ?>&email=&status=<?= $sortByStatus ?>&page=<?= $page ?>">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                </a>
            <?php endif ?>
        </th>
        <th>
            Status
            <?php if (!$sortByStatus) : ?>
                <a class="text-success"
                   href="/tasks?username=<?= $sortByUsername ?>&email=<?= $sortByEmail ?>&status=ASC&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                </a>
                <a class="text-success"
                   href="/tasks?username=<?= $sortByUsername ?>&email=<?= $sortByEmail ?>&status=DESC&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                </a>
            <?php elseif ($sortByStatus == 'ASC') : ?>
                <span>&uarr;</span>
                <a class="text-success"
                   href="/tasks?username=<?= $sortByUsername ?>&email=<?= $sortByEmail ?>&status=DESC&page=<?= $page ?>">
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                </a>
                <a class="text-danger"
                   href="/tasks?username=<?= $sortByUsername ?>&email=<?= $sortByEmail ?>&status=&page=<?= $page ?>">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                </a>
            <?php else : ?>
                <span>&darr;</span>
                <a class="text-success"
                   href="/tasks?username=<?= $sortByUsername ?>&email=<?= $sortByEmail ?>&status=ASC&page=<?= $page ?>">
                    <i class="fas fa-chevron-circle-up" aria-hidden="true"></i>
                </a>
                <a class="text-danger"
                   href="/tasks?username=<?= $sortByUsername ?>&email=<?= $sortByEmail ?>&status=&page=<?= $page ?>">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>
                </a>
            <?php endif ?>
        </th>
        <th>
            Actions
        </th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($rows as $n => $row) : ?>
        <tr class="">
            <td><?= ($page - 1) * $pageSize + $n + 1 ?></td>
            <td>
                <?php $url = Task::imageUrl($row->media_id, $this->getApp()->getDb()) ?>
                <img class="img-thumbnail"  height="240" width="320" src="<?= $url ?>"/>
            </td>
            <td><?= $row->username ?></td>
            <td><?= $row->email ?></td>
            <td>
                <?php if ($row->status): ?>
                    <i class="fas fa-check-circle text-success" aria-hidden="true"></i> Done
                <?php else: ?>
                    <i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i> Pending
                <?php endif ?>
            </td>
            <td>
                <button type="button" class="btn btn-info btn-sm"
                        data-toggle="modal"
                        data-target="#view-modal"
                        data-img="<?= $url ?>"
                        data-user="<?= $row->username ?>"
                        data-email="<?= $row->email ?>"
                        data-text="<?= $row->content ?>"
                        data-status="<?= $row->status ?>">
                    <i class="fas fa-eye" aria-hidden="true"></i>
                </button>

                <?php if ($canAccept) : ?>
                    <a class="btn btn-sm btn-info"
                       href="/task/<?= $row->id ?>/accept?status=<?= $row->status == 1 ? 0 : 1 ?>">
                        <?php if ($row->status): ?>
                            <i class="fas fa-times-circle" aria-hidden="true"></i>
                        <?php else: ?>
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                        <?php endif ?>
                    </a>
                    <a class="btn btn-sm btn-danger" href="/task/<?= $row->id ?>/delete">
                        <i class="fas fa-trash" aria-hidden="true"></i>
                    </a>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<?php if (!$pagesTotal) : ?>
    <div class="alert alert-info" role="alert">
        No task found
    </div>
<?php else : ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?= $pagination->previous(
                '<li class="page-item"><a class="page-link" href="{url}{nr}"><span aria-hidden="true">&laquo;</span></a><span class="sr-only">Previous</span></a></li>',
                '<li class="page-item disabled"><a class="page-link" href="{url}{nr}" tabindex="-1"><span aria-hidden="true">&laquo;</span></a><span class="sr-only">NePreviousxt</span></a></li>'
            ) ?>
            <?= $pagination->numbers(
                '<li class="page-item"><a class="page-link" href="{url}{nr}">{nr}<span class="sr-only">(current)</span></a></li>',
                '<li class="page-item active"><a class="page-link" href="#">{nr}<span class="sr-only">(current)</span></a></li>'
            ) ?>
            <?= $pagination->next(
                '<li class="page-item"><a class="page-link" href="{url}{nr}"><span aria-hidden="true">&raquo;</span></a><span class="sr-only">Next</span></li>',
                '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>'
            ) ?>
        </ul>
    </nav>

    <div class="text-center">
        <?= $pagination->info('Total: {total}') ?>
    </div>

<?php endif ?>
