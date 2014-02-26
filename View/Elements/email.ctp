<?php
	$parsedMessage = new MimeMailParser\Parser();
	$parsedMessage->setText($message['message']);
?>
<div class="list-group-item">
	<?php if (!empty($actions)) : ?>
		<div class="pull-right btn-group">
			<?=implode('\n', $actions);?>
		</div>
	<?php endif; ?>

	<h4 class="list-group-heading"><?=h($parsedMessage->getHeader('subject'));?></h4>
	<p class="list-group-body">
		<strong>From: </strong><?=h($parsedMessage->getHeader('from'));?>
	</p>
</div>