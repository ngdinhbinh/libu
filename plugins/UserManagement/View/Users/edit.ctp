<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password',array('value'=>''));
		echo $this->Form->input('group_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('plugin'=>'UserManagement','controller' => 'Users','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('plugin'=>'UserManagement','controller' => 'Groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('plugin'=>'UserManagement','controller' => 'Groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
