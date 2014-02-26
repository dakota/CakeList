<div class="pull-right btn-group">
	<?=$this->Html->link(__('Back to %s', $domain['Domain']['domain']), array('controller' => 'domains', 'action' => 'view', $domain['Domain']['id']), array('class' => 'btn btn-primary')); ?>
</div>

<div class="mailLists form">
<?php echo $this->Form->create('MailList', array('class' => 'form-horizontal', 'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array(
			'class' => 'col col-md-3 control-label'
		),
		'wrapInput' => 'col col-md-9',
		'class' => 'form-control'
	))); ?>
	<fieldset>
		<legend><?=(isset($this->request->data['MailList']['id']) ? __('Edit mailing list') : __('Create a mailing list for %s', $domain['Domain']['domain'])); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('domain_id', array(
			'value' => $this->request->params['pass'][0],
			'type' => 'hidden'
		));
		echo $this->Form->input('address', array(
			'label' => 'Mailing list address',
			'beforeInput' => '<div class="input-group">',
			'afterInput' => '<span class="input-group-addon">@' . $domain['Domain']['domain'] . '</span></div>'
		));
		echo $this->Form->input('subject_prefix', array(
			'label' => 'Prefix to add to subject lines',
			'beforeInput' => '<div class="input-group"><span class="input-group-addon">[</span>',
			'afterInput' => '<span class="input-group-addon">]</span></div>'
		));
		echo $this->Form->input('description');
		echo $this->Form->submit(__('Save this mailing list'), array(
			'div' => 'form-group',
			'class' => 'btn btn-default'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>