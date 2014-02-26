<div class="pull-right btn-group">
	<?=$this->Html->link(__('Back to list of domains', $mailList['Domain']['domain']), array('controller' => 'domains', 'action' => 'index', '#' => 'domain-' . $mailList['Domain']['domain']), array('class' => 'btn btn-default')); ?>
	<?=$this->Html->link(__('Create a member'), array('controller' => 'members', 'action' => 'add', $mailList['MailList']['id']), array('class' => 'btn btn-primary')); ?>	
	<?=$this->Html->link(__('Create lots of members'), array('controller' => 'members', 'action' => 'add_many', $mailList['MailList']['id']), array('class' => 'btn btn-primary')); ?>	
</div>

<div class="mail-lists view">
	<h2 class="page-header"><?=$mailList['MailList']['address'] . '@' . $mailList['Domain']['domain']?></h2>
	<p class="lead"><?=$mailList['MailList']['description']; ?></p>
	<p>
		<strong>Subject line prefix: </strong>[<?=$mailList['MailList']['subject_prefix']; ?>]
	</p>

<ul class="nav nav-tabs">
	<li>
		<a href="#members" data-toggle="tab">
			Members <span class="badge"><?=count($mailList['Member'])?></span>
		</a>
	</li>
	<li class="active">
		<a href="#moderation-queue" data-toggle="tab">
			Moderation queue <span class="badge"><?=$mailList['MailList']['moderation_queue_count']?></span>
		</a>
	</li>
	<li>
		<a href="#archive" data-toggle="tab">
			Archive <span class="badge"><?=$mailList['MailList']['archived_message_count']?></span>
		</a>
	</li>	
</ul>

<div class="tab-content">
	<div class="tab-pane" id="members">
		<?php if (!empty($mailList['Member'])) : ?>
			<div class="list-group">
				<?php foreach ($mailList['Member'] as $member) : ?>
					<div class="list-group-item">
						<div class="btn-group pull-right">
							<?=$this->Html->link('<span class="glyphicon glyphicon-trash"></span>', array('controller' => 'mail_lists', 'action' => 'remove_member', $mailList['MailList']['id'], $member['id']), array('class' => 'btn btn-default', 'escape' => false)); ?>							
						</div>
						<h4 class="list-group-heading"><?=$member['name']?></h4>
						<p class="list-group-text"><?=$member['email_address']?></p>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<p>
				You don't have any members yet. You should probably <?=$this->Html->link(__('create one'), array('controller' => 'members', 'action' => 'add', $mailList['MailList']['id'])); ?>.
			 Or you could create <?=$this->Html->link(__('create many at once'), array('controller' => 'members', 'action' => 'add_many', $mailList['MailList']['id'])); ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="tab-pane active" id="moderation-queue">
		<?php if (!empty($mailList['ModerationQueue'])) : ?>
			<div class="list-group">
				<?php
					foreach ($mailList['ModerationQueue'] as $moderationMessage) {
						echo $this->element('email', [
							'message' => $moderationMessage,
							'actions' => [
								$this->Html->link(__('Approve'), ['controller' => 'moderation_queues', 'action' => 'approve', $moderationMessage['id']], ['class' => 'btn btn-primary'])
							]
						]);
					}
				?>
			</div>
		<?php else: ?>
			<p>No messages waiting for moderation</p>
		<?php endif; ?>
	</div>

	<div class="tab-pane" id="archive">
		<?php if (!empty($mailList['ArchivedMessage'])) : ?>
			<div class="list-group">
				<?php
					foreach ($mailList['ArchivedMessage'] as $mailMessage) {
						echo $this->element('email', [
							'message' => $mailMessage,
						]);
					}
				?>
			</div>
		<?php else: ?>
			<p>No archived messages</p>
		<?php endif; ?>
	</div>	
</div>
