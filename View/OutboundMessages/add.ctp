<div class="outboundMessages form">
<?php echo $this->Form->create('OutboundMessage'); ?>
	<fieldset>
		<legend><?php echo __('Add Outbound Message'); ?></legend>
	<?php
		echo $this->Form->input('mail_list_id');
		echo $this->Form->input('message');
		echo $this->Form->input('moderated');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Outbound Messages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
