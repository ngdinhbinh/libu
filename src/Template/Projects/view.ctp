<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Project'), ['action' => 'edit', $project->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Project'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="projects view large-10 medium-9 columns">
    <h2><?= h($project->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($project->name) ?></p>
            <h6 class="subheader"><?= __('Project Key') ?></h6>
            <p><?= h($project->project_key) ?></p>
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $project->has('user') ? $this->Html->link($project->user->name, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($project->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created Date') ?></h6>
            <p><?= h($project->created_date) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tasks') ?></h4>
    <?php if (!empty($project->tasks)): ?>
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
        <?php foreach ($project->tasks as $tasks): ?>
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
