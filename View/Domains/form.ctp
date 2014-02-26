<div class="pull-right btn-group">
	<?=$this->Html->link(__('Back to domain list'), array('action' => 'index'), array('class' => 'btn btn-primary')); ?>
</div>

<div class="domains form">
<?php echo $this->Form->create('Domain', array('class' => 'form-horizontal', 'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array(
			'class' => 'col col-md-3 control-label'
		),
		'wrapInput' => 'col col-md-9',
		'class' => 'form-control'
	))); ?>
	<fieldset>
		<legend><?=(isset($this->request->data['Domain']['id']) ? __('Edit a domain') : __('Create a domain')); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('domain', array(
			'label' => 'Domain name',
			'beforeInput' => '<div class="input-group"><span class="input-group-addon">@</span>',
			'afterInput' => '</div>'
		));
		echo $this->Form->input('description', array(
			'label' => 'A description for the domain'
		));
		echo $this->Form->submit(__('Save this domain'), array(
			'div' => 'form-group',
			'class' => 'btn btn-default'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
