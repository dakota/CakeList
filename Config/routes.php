<?php
	Router::connect('/', array('controller' => 'domains', 'action' => 'index'));

	App::uses('ListRoute', 'Routing/Route');
	Router::connect('/:mailingList@:domainName', array('controller' => 'mail_lists', 'action' => 'view'), array(
		'routeClass' => 'ListRoute'
	));
	Router::connect('/:mailingList@:domainName/createMember', array('controller' => 'members', 'action' => 'add'), array(
		'routeClass' => 'ListRoute'
	));
	Router::connect('/:mailingList@:domainName/createMembers', array('controller' => 'members', 'action' => 'add_many'), array(
		'routeClass' => 'ListRoute'
	));

	Router::connect('/:domainName', array('controller' => 'domains', 'action' => 'view'), array(
		'routeClass' => 'ListRoute'
	));
	Router::connect('/:domainName/create', array('controller' => 'mail_lists', 'action' => 'add'), array(
		'routeClass' => 'ListRoute'
	));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
