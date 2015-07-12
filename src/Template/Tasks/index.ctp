<div class="projects index large-10 medium-9 columns">
    <table class="table table-bordered table-striped dataTable" id="dataTable1" >
	<thead>
            <tr role="row">
                <th class="<?php if( isset( $_GET["sort"] ) && $_GET["sort"] == "id" ): echo $_GET["direction"] == "asc" ? "sorting_asc" : "sorting_desc"; else: echo "sorting"; endif;  ?>"><?= $this->Paginator->sort('id') ?></th>
                <th class="<?php if( isset( $_GET["sort"] ) && $_GET["sort"] == "name" ): echo $_GET["direction"] == "asc" ? "sorting_asc" : "sorting_desc"; else: echo "sorting"; endif;  ?>"><?= $this->Paginator->sort('name') ?></th>
                <th class="<?php if( isset( $_GET["sort"] ) && $_GET["sort"] == "project_id" ): echo $_GET["direction"] == "asc" ? "sorting_asc" : "sorting_desc"; else: echo "sorting"; endif;  ?>"><?= $this->Paginator->sort('project_id') ?></th>
                <th class="<?php if( isset( $_GET["sort"] ) && $_GET["sort"] == "to_user" ): echo $_GET["direction"] == "asc" ? "sorting_asc" : "sorting_desc"; else: echo "sorting"; endif;  ?>"><?= $this->Paginator->sort('to_user') ?></th>
               
                <th class="<?php if( isset( $_GET["sort"] ) && $_GET["sort"] == "notification_type" ): echo $_GET["direction"] == "asc" ? "sorting_asc" : "sorting_desc"; else: echo "sorting"; endif;  ?>"><?= $this->Paginator->sort('notification_type') ?></th>
                <th class="<?php if( isset( $_GET["sort"] ) && $_GET["sort"] == "status" ): echo $_GET["direction"] == "asc" ? "sorting_asc" : "sorting_desc"; else: echo "sorting"; endif;  ?>"><?= $this->Paginator->sort('status') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
	</thead>
	<tbody role="alert">
	<?php $i=0; foreach ($tasks as $task): ?>
            <tr class="<?php echo $i % 2 == 0 ? "odd" : "even";  ?>">
                <?php $_task = $task['tasks']; ?>
                <?php $project = $task['p']; ?>
                <?php $to_user = $task['u']; ?>
               
                <td><?= $this->Number->format($_task['id']) ?></td>
                <td>
                     <a href='<?php echo $this->Url->build([ 'controller'=>'tasks', 'action'=> 'view', $_task['id']]) ?>'><?= h($_task['name']) ?></a>
                </td>
                <td>
                   <a href='<?php echo $this->Url->build([ 'controller'=>'projects', 'action'=> 'view', $project['id']]) ?>'><?= h($project['name']) ?></a>
                </td>
                <td><?= $to_user['name'] ?></td>
               
                <td><?= h($_task['notification_type']) ?></td>
                 <td><?= h($_task['status']) ?></td>
                <td class="actions">
                     <?= $this->Html->link( __(''), ['action' => 'view', $_task['id'] ], array( 'class' => 'table-actions fa fa-eye' ) ) ?>
                    <?= $this->Html->link(__(''), ['action' => 'edit', $_task['id'] ] , array( 'class' => 'table-actions fa fa-pencil' )) ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $_task['id'] ],  array( 'class' => 'table-actions fa fa-trash-o' ), ['confirm' => __('Are you sure you want to delete "{0}"?', $_task['name'] )] ) ?>
                   
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

