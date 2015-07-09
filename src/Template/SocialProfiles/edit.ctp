<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $socialProfile->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $socialProfile->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Social Profiles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="socialProfiles form large-10 medium-9 columns">
    <?= $this->Form->create($socialProfile) ?>
    <fieldset>
        <legend><?= __('Edit Social Profile') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('social_network_name');
            echo $this->Form->input('social_network_id');
            echo $this->Form->input('email');
            echo $this->Form->input('display_name');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('link');
            echo $this->Form->input('picture');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
