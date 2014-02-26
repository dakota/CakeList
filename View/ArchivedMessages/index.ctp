<div class="archivedMessages index">
	<h2><?php echo __('Archived Messages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('mail_list_id'); ?></th>
			<th><?php echo $this->Paginator->sort('message'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($archivedMessages as $archivedMessage): ?>
	<tr>
		<td><?php echo h($archivedMessage['ArchivedMessage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($archivedMessage['MailList']['name'], array('controller' => 'mail_lists', 'action' => 'view', $archivedMessage['MailList']['id'])); ?>
		</td>
		<td><?php echo h($archivedMessage['ArchivedMessage']['message']); ?>&nbsp;</td>
		<td><?php echo h($archivedMessage['ArchivedMessage']['created']); ?>&nbsp;</td>
		<td><?php echo h($archivedMessage['ArchivedMessage']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $archivedMessage['ArchivedMessage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $archivedMessage['ArchivedMessage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $archivedMessage['ArchivedMessage']['id']), null, __('Are you sure you want to delete # %s?', $archivedMessage['ArchivedMessage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Archived Message'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
