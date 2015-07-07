
<div class="projects index large-10 medium-9 columns">
    <table class="table table-bordered table-striped dataTable" id="dataTable1" >
		<thead>
			<tr role="row">
				<th><?= $this->Paginator->sort('id') ?></th>
				<th class="sorting" ><?= $this->Paginator->sort('name') ?></th>
				<th class="sorting" ><?= $this->Paginator->sort('created_date') ?></th>
				<th class="sorting" ><?= $this->Paginator->sort('project_key') ?></th>
				<th class="sorting" ><?= $this->Paginator->sort('user_id') ?></th>
				<th class="actions"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody role="alert">
		<?php $i=0; foreach ($projects as $project): ?>
			<tr class="<?php echo $i % 2 == 0 ? "odd" : "even";  ?>">
				<td><?= $this->Number->format($project->id) ?></td>
				<td><?= h($project->name) ?></td>
				<td><?= h($project->created_date) ?></td>
				<td><?= h($project->project_key) ?></td>
				<td>
					<?= $project->has('user') ? $this->Html->link($project->user->name, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?>
				</td>
				<td class="actions">
					<?= $this->Html->link( __(''), ['action' => 'view', $project->id], array( 'class' => 'table-actions fa fa-eye' ) ) ?>
					<?= $this->Html->link(__(''), ['action' => 'edit', $project->id] , array( 'class' => 'table-actions fa fa-pencil' )) ?>
					<?= $this->Form->postLink(__(''), ['action' => 'delete', $project->id],  array( 'class' => 'table-actions fa fa-trash-o' ), ['confirm' => __('Are you sure you want to delete "{0}"?', $project->name)] ) ?>
				</td>
			</tr>

		<?php $i = $i + 1; endforeach; ?>
		</tbody>
    </table>
	<div class="dataTables_info" id="dataTable1_info"><?= $this->Paginator->counter() ?></div>
	<div class="dataTables_paginate paging_full_numbers" id="dataTable1_paginate">
		<ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
	</div>
</div>
