<div class="pull-right btn-group">
	<?=$this->Html->link(__('Create a new domain'), array('action' => 'add'), array('class' => 'btn btn-primary')); ?>
</div>

<div class="domains index">
	<h2 class="page-header"><?=__('Domains'); ?></h2>
	<?php if (!empty($domains)) : ?>
		<div class="panel-group">
			<?php foreach ($domains as $domain) : ?>
				<div class="panel panel-default" id="domain-<?=$domain['Domain']['domain']?>">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?=$domain['Domain']['domain']?>
							<span class="badge pull-right"><?=__n('%d mailing list', '%d mailing lists', count($domain['MailList']), count($domain['MailList']))?></span>
						</h3>
					</div>
					<div class="panel-body">
						<p><?=nl2br($domain['Domain']['description'])?></p>
						<?php if (count($domain['MailList']) == 0) : ?>
							<p>The <?=$domain['Domain']['domain']?> domain doesn't have any mailing lists yet. You should probably <?=$this->Html->link(__('create one'), array('controller' => 'mail_lists', 'action' => 'add', $domain['Domain']['id'])); ?>.</p>							
						<?php endif; ?>
					</div>

					<?php if (count($domain['MailList']) > 0) : ?>
						<div class="list-group">
							<?php foreach ($domain['MailList'] as $mailList) :?>
								<a href="<?=$this->Html->url(array('controller' => 'mail_lists', 'action' => 'view', $mailList['id']));?>" class="list-group-item">
									<span class="badge"><?=__n('%d queued message', '%d queued messages', $mailList['moderation_queue_count'], $mailList['moderation_queue_count'])?></span>									
									<?=$mailList['address'] . '@' . $domain['Domain']['domain']?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<div class="panel-footer">
						<?=$this->Html->link(__('Create a new mailing list for %s', $domain['Domain']['domain']), array('controller' => 'mail_lists', 'action' => 'add', $domain['Domain']['id']), array('class' => 'btn btn-primary')); ?>
					</div>						
				</div>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p>You don't have any domains yet. You should probably <?=$this->Html->link(__('create one'), array('action' => 'add')); ?>.</p>
	<?php endif; ?>
</div>
