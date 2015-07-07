<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Attachments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="attachments form large-10 medium-9 columns">
    <?= $this->Form->create($attachment) ?>
    <fieldset>
        <legend><?= __('Add Attachment') ?></legend>
        <?php
            echo $this->Form->input('object_id');
            echo $this->Form->input('object_type');
            echo $this->Form->input('attach_type');
            echo $this->Form->input('url');
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('created_date');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
