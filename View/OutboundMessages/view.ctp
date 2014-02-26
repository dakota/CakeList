<div class="outboundMessages view">
<h2><?php echo __('Outbound Message'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($outboundMessage['OutboundMessage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail List'); ?></dt>
		<dd>
			<?php echo $this->Html->link($outboundMessage['MailList']['name'], array('controller' => 'mail_lists', 'action' => 'view', $outboundMessage['MailList']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($outboundMessage['OutboundMessage']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Moderated'); ?></dt>
		<dd>
			<?php echo h($outboundMessage['OutboundMessage']['moderated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($outboundMessage['OutboundMessage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($outboundMessage['OutboundMessage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Outbound Message'), array('action' => 'edit', $outboundMessage['OutboundMessage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Outbound Message'), array('action' => 'delete', $outboundMessage['OutboundMessage']['id']), null, __('Are you sure you want to delete # %s?', $outboundMessage['OutboundMessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Outbound Messages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outbound Message'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
