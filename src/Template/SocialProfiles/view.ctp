<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Social Profile'), ['action' => 'edit', $socialProfile->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Social Profile'), ['action' => 'delete', $socialProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $socialProfile->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Social Profiles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Social Profile'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="socialProfiles view large-10 medium-9 columns">
    <h2><?= h($socialProfile->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $socialProfile->has('user') ? $this->Html->link($socialProfile->user->name, ['controller' => 'Users', 'action' => 'view', $socialProfile->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Social Network Name') ?></h6>
            <p><?= h($socialProfile->social_network_name) ?></p>
            <h6 class="subheader"><?= __('Social Network Id') ?></h6>
            <p><?= h($socialProfile->social_network_id) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($socialProfile->email) ?></p>
            <h6 class="subheader"><?= __('Display Name') ?></h6>
            <p><?= h($socialProfile->display_name) ?></p>
            <h6 class="subheader"><?= __('First Name') ?></h6>
            <p><?= h($socialProfile->first_name) ?></p>
            <h6 class="subheader"><?= __('Last Name') ?></h6>
            <p><?= h($socialProfile->last_name) ?></p>
            <h6 class="subheader"><?= __('Link') ?></h6>
            <p><?= h($socialProfile->link) ?></p>
            <h6 class="subheader"><?= __('Picture') ?></h6>
            <p><?= h($socialProfile->picture) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($socialProfile->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($socialProfile->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($socialProfile->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Status') ?></h6>
            <p><?= $socialProfile->status ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
