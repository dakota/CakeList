<div class="mailLists form">
<?php echo $this->Form->create('MailList'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mail List'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('domain_id');
		echo $this->Form->input('address');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('Member');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MailList.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MailList.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Domains'), array('controller' => 'domains', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domain'), array('controller' => 'domains', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outbound Messages'), array('controller' => 'outbound_messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outbound Message'), array('controller' => 'outbound_messages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archived Messages'), array('controller' => 'archived_messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archived Message'), array('controller' => 'archived_messages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
