<div class="pull-right btn-group">
	<?=$this->Html->link(__('Back to list of domains'), array('action' => 'index'), array('class' => 'btn btn-default')); ?>
	<?=$this->Html->link(__('Create a new mailing list'), array('controller' => 'mail_lists', 'action' => 'add', $domain['Domain']['id']), array('class' => 'btn btn-primary')); ?>
</div>

<div class="domains view">
	<h2 class="page-header"><?=$domain['Domain']['domain']; ?> mailing lists</h2>
	<p class="lead"><?=$domain['Domain']['description']; ?></p>

	<?php if (!empty($domain['MailList'])) : ?>
		<div class="list-group">
			<?php foreach ($domain['MailList'] as $mailList) : ?>
			<a href="<?=$this->Html->url(array('controller' => 'mail_lists', 'action' => 'view', $mailList['id']));?>" class="list-group-item">
				<h4 class="list-group-item-heading"><?=$mailList['address'] . '@' . $domain['Domain']['domain']?></h4>
				<p class="list-group-item-text"><?=$mailList['description']?></p>		
			</a>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p>You don't have any mailing lists yet. You should probably <?=$this->Html->link(__('create one'), array('controller' => 'mail_lists', 'action' => 'add', $domain['Domain']['id'])); ?>.</p>
	<?php endif; ?>	
</div>
