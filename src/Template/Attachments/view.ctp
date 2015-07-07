<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Attachment'), ['action' => 'edit', $attachment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Attachment'), ['action' => 'delete', $attachment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attachment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Attachments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attachment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="attachments view large-10 medium-9 columns">
    <h2><?= h($attachment->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Object Type') ?></h6>
            <p><?= h($attachment->object_type) ?></p>
            <h6 class="subheader"><?= __('Attach Type') ?></h6>
            <p><?= h($attachment->attach_type) ?></p>
            <h6 class="subheader"><?= __('Url') ?></h6>
            <p><?= h($attachment->url) ?></p>
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $attachment->has('user') ? $this->Html->link($attachment->user->name, ['controller' => 'Users', 'action' => 'view', $attachment->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($attachment->description) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($attachment->id) ?></p>
            <h6 class="subheader"><?= __('Object Id') ?></h6>
            <p><?= $this->Number->format($attachment->object_id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created Date') ?></h6>
            <p><?= h($attachment->created_date) ?></p>
        </div>
    </div>
</div>
