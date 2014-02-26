<div class="archivedMessages form">
<?php echo $this->Form->create('ArchivedMessage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Archived Message'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mail_list_id');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ArchivedMessage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ArchivedMessage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Archived Messages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
