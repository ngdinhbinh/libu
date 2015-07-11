<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Tasks File Attach'), ['action' => 'edit', $tasksFileAttach->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tasks File Attach'), ['action' => 'delete', $tasksFileAttach->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tasksFileAttach->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tasks File Attach'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tasks File Attach'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attachments'), ['controller' => 'Attachments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attachment'), ['controller' => 'Attachments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="tasksFileAttach view large-10 medium-9 columns">
    <h2><?= h($tasksFileAttach->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Task') ?></h6>
            <p><?= $tasksFileAttach->has('task') ? $this->Html->link($tasksFileAttach->task->name, ['controller' => 'Tasks', 'action' => 'view', $tasksFileAttach->task->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Attachment') ?></h6>
            <p><?= $tasksFileAttach->has('attachment') ? $this->Html->link($tasksFileAttach->attachment->id, ['controller' => 'Attachments', 'action' => 'view', $tasksFileAttach->attachment->id]) : '' ?></p>
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $tasksFileAttach->has('user') ? $this->Html->link($tasksFileAttach->user->name, ['controller' => 'Users', 'action' => 'view', $tasksFileAttach->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($tasksFileAttach->description) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($tasksFileAttach->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Attach Date') ?></h6>
            <p><?= h($tasksFileAttach->attach_date) ?></p>
        </div>
    </div>
</div>
