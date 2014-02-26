<div class="mailListsMembers index">
	<h2><?php echo __('Mail Lists Members'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('mail_list_id'); ?></th>
			<th><?php echo $this->Paginator->sort('member_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mailListsMembers as $mailListsMember): ?>
	<tr>
		<td><?php echo h($mailListsMember['MailListsMember']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($mailListsMember['MailList']['name'], array('controller' => 'mail_lists', 'action' => 'view', $mailListsMember['MailList']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($mailListsMember['Member']['id'], array('controller' => 'members', 'action' => 'view', $mailListsMember['Member']['id'])); ?>
		</td>
		<td><?php echo h($mailListsMember['MailListsMember']['created']); ?>&nbsp;</td>
		<td><?php echo h($mailListsMember['MailListsMember']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mailListsMember['MailListsMember']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mailListsMember['MailListsMember']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mailListsMember['MailListsMember']['id']), null, __('Are you sure you want to delete # %s?', $mailListsMember['MailListsMember']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Mail Lists Member'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
