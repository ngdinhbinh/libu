<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Tasks File Attach'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attachments'), ['controller' => 'Attachments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attachment'), ['controller' => 'Attachments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="tasksFileAttach index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('task_id') ?></th>
            <th><?= $this->Paginator->sort('attachment_id') ?></th>
            <th><?= $this->Paginator->sort('attach_date') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tasksFileAttach as $tasksFileAttach): ?>
        <tr>
            <td><?= $this->Number->format($tasksFileAttach->id) ?></td>
            <td>
                <?= $tasksFileAttach->has('task') ? $this->Html->link($tasksFileAttach->task->name, ['controller' => 'Tasks', 'action' => 'view', $tasksFileAttach->task->id]) : '' ?>
            </td>
            <td>
                <?= $tasksFileAttach->has('attachment') ? $this->Html->link($tasksFileAttach->attachment->id, ['controller' => 'Attachments', 'action' => 'view', $tasksFileAttach->attachment->id]) : '' ?>
            </td>
            <td><?= h($tasksFileAttach->attach_date) ?></td>
            <td>
                <?= $tasksFileAttach->has('user') ? $this->Html->link($tasksFileAttach->user->name, ['controller' => 'Users', 'action' => 'view', $tasksFileAttach->user->id]) : '' ?>
            </td>
            <td><?= h($tasksFileAttach->description) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $tasksFileAttach->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tasksFileAttach->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tasksFileAttach->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tasksFileAttach->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
