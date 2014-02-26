<?php
class EmailConfig {

/**
 * Default email config for SMTP emails
 *
 * Remember to change the default 'From' address here!
 * 
 * @var array
 */
	public $default = array(
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'log' => true,
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
		'headers' => [
			'X-Mailer' => 'CakeList'
		]
	);

	public $mailCatcher = array(
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 1025,
		'timeout' => 30,
		'log' => true,
		'charset' => 'utf-8',
		'headerCharset' => 'utf-8',
		'headers' => [
			'X-Mailer' => 'CakeList'
		]
	);

}
