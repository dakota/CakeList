<div class="archivedMessages view">
<h2><?php echo __('Archived Message'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($archivedMessage['ArchivedMessage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail List'); ?></dt>
		<dd>
			<?php echo $this->Html->link($archivedMessage['MailList']['name'], array('controller' => 'mail_lists', 'action' => 'view', $archivedMessage['MailList']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($archivedMessage['ArchivedMessage']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($archivedMessage['ArchivedMessage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($archivedMessage['ArchivedMessage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Archived Message'), array('action' => 'edit', $archivedMessage['ArchivedMessage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Archived Message'), array('action' => 'delete', $archivedMessage['ArchivedMessage']['id']), null, __('Are you sure you want to delete # %s?', $archivedMessage['ArchivedMessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Archived Messages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archived Message'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mail Lists'), array('controller' => 'mail_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mail List'), array('controller' => 'mail_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
