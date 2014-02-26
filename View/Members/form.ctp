<div class="pull-right btn-group">
	<?=$this->Html->link(__('Back to %s', $mailList['MailList']['name']), array('controller' => 'mail_lists', 'action' => 'view', $mailList['MailList']['id']), array('class' => 'btn btn-primary')); ?>
</div>

<div class="members form">
<?php echo $this->Form->create('Member', array('class' => 'form-horizontal', 'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array(
			'class' => 'col col-md-3 control-label'
		),
		'wrapInput' => 'col col-md-9',
		'class' => 'form-control'
	))); ?>
	<fieldset>
		<legend><?=(isset($this->request->data['Member']['id']) ? __('Edit member') : __('Create a member for %s', $mailList['MailList']['name'])); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email_address');
		echo $this->Form->input('MailList', array(
			'value' => $mailList['MailList']['id'],
			'type' => 'hidden'
		));
		echo $this->Form->submit(__('Save this member'), array(
			'div' => 'form-group',
			'class' => 'btn btn-default'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>