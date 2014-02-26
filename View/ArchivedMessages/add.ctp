<div class="archivedMessages form">
<?php echo $this->Form->create('ArchivedMessage'); ?>
	<fieldset>
		<legend><?php echo __('Add Archived Message'); ?></legend>
	<?php
		echo $this->Form->input('mail_list_id');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Archived Messages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
