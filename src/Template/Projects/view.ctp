<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <span class="uppercase" style='font-size: 30px;font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;  font-weight: 300;'><?= h($project->name) ?></span>
                <span style="color:red"><b> (<?= h($project->project_key) ?>) </b></span>
                <p><b>Created date:</b> <?php $created_date = new DateTime($project->created_date); echo $created_date->format('Y-m-d H:i A'); ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <h3><?= __('Related Tasks') ?></h3>

            <?php if (!empty($project->tasks)): ?>
                <table class="table table-bordered table-striped dataTable" id="dataTable1" >
                    <thead>
                        <tr role="row">
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('To User') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Notification Type') ?></th>
                            <th><?= __('Notification Value') ?></th>
                            <th><?= __('Created date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody role="alert">
                        <?php foreach ($tasks as $o_task): ?>
                            <?php $task = $o_task['tasks']; ?>
                            <?php $to_user = $o_task['u']; ?>
                            <tr>
                                <td><a href="<?= $this->Url->build(["controller"=>"tasks","action"=>"edit", $task['id'] ]) ?>"><?= h($task['id']) ?></a></td>
                                <td><a href="<?= $this->Url->build(["controller"=>"tasks","action"=>"view", $task['id'] ]) ?>"><?= h($task['name']) ?></a></td>
                                <td><?= h($to_user['name']) ?></td>
                                <td><?= h($task['status']) ?></td>
                                <td><?= h($task['notification_type']) ?></td>
                                <td><?= h($task['notification_value']) ?></td>
                                <td><?php $created_date = new DateTime($task['created_date']); echo $created_date->format('Y-m-d H:i A'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__(''), ['controller' => 'Tasks', 'action' => 'view', $task['id']], array('class' => 'table-actions fa fa-eye')) ?>
                                    <?= $this->Html->link(__(''), ['controller' => 'Tasks', 'action' => 'edit', $task['id']], array('class' => 'table-actions fa fa-pencil')) ?>
                                    <?= $this->Form->postLink(__(''), ['controller' => 'Tasks', 'action' => 'delete', $task['id']], array('class' => 'table-actions fa fa-trash-o'), ['confirm' => __('Are you sure you want to delete "{0}"?', $task['name'])]) ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>
    </div>
</div>



