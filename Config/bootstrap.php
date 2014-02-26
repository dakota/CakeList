<?php
// Load Composer autoload.
require APP . '/Vendor/autoload.php';

// Remove and re-prepend CakePHP's autoloader as Composer thinks it is the
// most important.
// See: http://goo.gl/kKVJO7
spl_autoload_unregister(array('App', 'load'));
spl_autoload_register(array('App', 'load'), true, true);

$engine = 'Memcache';

// In development mode, caches should expire quickly.
$duration = '+1 day';
if (Configure::read('debug') > 0) {
	$duration = '+10 seconds';
}

// Prefix each application on the same server with a different string, to avoid Memcache and APC conflicts.
$prefix = 'OctoCake_';

Cache::config('default', array(
	'engine' => $engine,
	'mask' => 0777,
	'duration' => $duration,
	'prefix' => $prefix
));

CakePlugin::load(array(
	'DebugKit',
	'DebugKitEx',
	'Migrations',
	'Search',
	'ClearCache',
	'BoostCake',
	'CakeResque' => array(
		'bootstrap' => array(
			'bootstrap_config',
			'../../../Config/cakeresque_config', # Path to your own config file
			'bootstrap'
		)
	)
));

Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));