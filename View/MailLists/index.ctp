<div class="mailLists index">
	<h2><?php echo __('Mail Lists'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('domain_id'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mailLists as $mailList): ?>
	<tr>
		<td><?php echo h($mailList['MailList']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($mailList['Domain']['id'], array('controller' => 'domains', 'action' => 'view', $mailList['Domain']['id'])); ?>
		</td>
		<td><?php echo h($mailList['MailList']['address']); ?>&nbsp;</td>
		<td><?php echo h($mailList['MailList']['name']); ?>&nbsp;</td>
		<td><?php echo h($mailList['MailList']['description']); ?>&nbsp;</td>
		<td><?php echo h($mailList['MailList']['created']); ?>&nbsp;</td>
		<td><?php echo h($mailList['MailList']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mailList['MailList']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mailList['MailList']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mailList['MailList']['id']), null, __('Are you sure you want to delete # %s?', $mailList['MailList']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Mail List'), array('action' => 'add')); ?></li>
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
