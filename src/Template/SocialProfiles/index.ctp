<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Social Profile'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="socialProfiles index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('social_network_name') ?></th>
            <th><?= $this->Paginator->sort('social_network_id') ?></th>
            <th><?= $this->Paginator->sort('email') ?></th>
            <th><?= $this->Paginator->sort('display_name') ?></th>
            <th><?= $this->Paginator->sort('first_name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($socialProfiles as $socialProfile): ?>
        <tr>
            <td><?= $this->Number->format($socialProfile->id) ?></td>
            <td>
                <?= $socialProfile->has('user') ? $this->Html->link($socialProfile->user->name, ['controller' => 'Users', 'action' => 'view', $socialProfile->user->id]) : '' ?>
            </td>
            <td><?= h($socialProfile->social_network_name) ?></td>
            <td><?= h($socialProfile->social_network_id) ?></td>
            <td><?= h($socialProfile->email) ?></td>
            <td><?= h($socialProfile->display_name) ?></td>
            <td><?= h($socialProfile->first_name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $socialProfile->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $socialProfile->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $socialProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $socialProfile->id)]) ?>
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
