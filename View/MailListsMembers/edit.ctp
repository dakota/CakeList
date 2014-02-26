<div class="mailListsMembers form">
<?php echo $this->Form->create('MailListsMember'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mail Lists Member'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mail_list_id');
		echo $this->Form->input('member_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MailListsMember.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MailListsMember.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mail Lists Members'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
