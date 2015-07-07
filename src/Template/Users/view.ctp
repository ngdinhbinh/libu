<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks User'), ['controller' => 'TasksUser', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tasks User'), ['controller' => 'TasksUser', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="users view large-10 medium-9 columns">
    <h2><?= h($user->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($user->name) ?></p>
            <h6 class="subheader"><?= __('Firstname') ?></h6>
            <p><?= h($user->firstname) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($user->lastname) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($user->email) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= h($user->password) ?></p>
            <h6 class="subheader"><?= __('Activation Key') ?></h6>
            <p><?= h($user->activation_key) ?></p>
            <h6 class="subheader"><?= __('Status') ?></h6>
            <p><?= h($user->status) ?></p>
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= h($user->role) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($user->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Register Date') ?></h6>
            <p><?= h($user->register_date) ?></p>
            <h6 class="subheader"><?= __('Activation Date') ?></h6>
            <p><?= h($user->activation_date) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Comments') ?></h4>
    <?php if (!empty($user->comments)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Created Date') ?></th>
            <th><?= __('Task Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->comments as $comments): ?>
        <tr>
            <td><?= h($comments->id) ?></td>
            <td><?= h($comments->name) ?></td>
            <td><?= h($comments->created_date) ?></td>
            <td><?= h($comments->task_id) ?></td>
            <td><?= h($comments->user_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Projects') ?></h4>
    <?php if (!empty($user->projects)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Created Date') ?></th>
            <th><?= __('Project Key') ?></th>
            <th><?= __('User Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->projects as $projects): ?>
        <tr>
            <td><?= h($projects->id) ?></td>
            <td><?= h($projects->name) ?></td>
            <td><?= h($projects->created_date) ?></td>
            <td><?= h($projects->project_key) ?></td>
            <td><?= h($projects->user_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projects', 'action' => 'delete', $projects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projects->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tasks') ?></h4>
    <?php if (!empty($user->tasks)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Project Id') ?></th>
            <th><?= __('To User') ?></th>
            <th><?= __('Cc User') ?></th>
            <th><?= __('Subject') ?></th>
            <th><?= __('Allow Attachment') ?></th>
            <th><?= __('Notification Type') ?></th>
            <th><?= __('Notification Value') ?></th>
            <th><?= __('User Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->tasks as $tasks): ?>
        <tr>
            <td><?= h($tasks->id) ?></td>
            <td><?= h($tasks->name) ?></td>
            <td><?= h($tasks->project_id) ?></td>
            <td><?= h($tasks->to_user) ?></td>
            <td><?= h($tasks->cc_user) ?></td>
            <td><?= h($tasks->subject) ?></td>
            <td><?= h($tasks->allow_attachment) ?></td>
            <td><?= h($tasks->notification_type) ?></td>
            <td><?= h($tasks->notification_value) ?></td>
            <td><?= h($tasks->user_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Tasks', 'action' => 'view', $tasks->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Tasks', 'action' => 'edit', $tasks->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tasks', 'action' => 'delete', $tasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tasks->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tasks User') ?></h4>
    <?php if (!empty($user->tasks_user)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Task Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Created Date') ?></th>
            <th><?= __('Description') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->tasks_user as $tasksUser): ?>
        <tr>
            <td><?= h($tasksUser->task_id) ?></td>
            <td><?= h($tasksUser->user_id) ?></td>
            <td><?= h($tasksUser->created_date) ?></td>
            <td><?= h($tasksUser->description) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'TasksUser', 'action' => 'view', $tasksUser->]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'TasksUser', 'action' => 'edit', $tasksUser->]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'TasksUser', 'action' => 'delete', $tasksUser->], ['confirm' => __('Are you sure you want to delete # {0}?', $tasksUser->)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
