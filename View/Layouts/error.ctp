<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>CakeList</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array(
			'/components/bootstrap/dist/css/bootstrap',
			'styles'
		));

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>

	<div class="container">
		<?php echo $this->fetch('content'); ?>
	</div>

	<?php
		echo $this->Html->script(array(
			'/components/jquery/jquery',
			'/components/bootstrap/dist/js/bootstrap',
		));
		echo $this->fetch('script');
	?>
</body>
</html>