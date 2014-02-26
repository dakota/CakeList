<div class="mailListsMembers view">
<h2><?php echo __('Mail Lists Member'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mailListsMember['MailListsMember']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail List'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mailListsMember['MailList']['name'], array('controller' => 'mail_lists', 'action' => 'view', $mailListsMember['MailList']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Member'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mailListsMember['Member']['id'], array('controller' => 'members', 'action' => 'view', $mailListsMember['Member']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mailListsMember['MailListsMember']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mailListsMember['MailListsMember']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mail Lists Member'), array('action' => 'edit', $mailListsMember['MailListsMember']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mail Lists Member'), array('action' => 'delete', $mailListsMember['MailListsMember']['id']), null, __('Are you sure you want to delete # %s?', $mailListsMember['MailListsMember']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mail Lists Members'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail Lists Member'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
