<?php
	Configure::write('debug', 2);

	Configure::write('Error', array(
		'handler' => 'ErrorHandler::handleError',
		'level' => E_ALL & ~E_DEPRECATED,
		'trace' => true
	));

	Configure::write('Exception', array(
		'handler' => 'ErrorHandler::handleException',
		'renderer' => 'ExceptionRenderer',
		'log' => true
	));

	Configure::write('App.encoding', 'UTF-8');

	Configure::write('Session', array(
		'defaults' => 'php'
	));

/**
 * Don't forget to change this to something else!
 */
	Configure::write('Security.salt', 'changeMe');

/**
 * Don't forget to change this to something else! Numeric only here
 */
	Configure::write('Security.cipherSeed', '123456');

	Configure::write('Asset.timestamp', true);

	$engine = 'Memcache';

// In development mode, caches should expire quickly.
	$duration = '+999 days';
	if (Configure::read('debug') > 0) {
		$duration = '+10 seconds';
	}

// Prefix each application on the same server with a different string, to avoid Memcache and APC conflicts.
	$prefix = 'OctoCake_';

/**
 * Configure the cache used for general framework caching. Path information,
 * object listings, and translation cache files are stored with this configuration.
 */
	Cache::config('_cake_core_', array(
		'engine' => $engine,
		'prefix' => $prefix . 'cake_core_',
		'path' => CACHE . 'persistent' . DS,
		'serialize' => ($engine === 'File'),
		'duration' => $duration,
		'mask' => 0777
	));

/**
 * Configure the cache for model and datasource caches. This cache configuration
 * is used to store schema descriptions, and table listings in connections.
 */
	Cache::config('_cake_model_', array(
		'engine' => $engine,
		'prefix' => $prefix . 'cake_model_',
		'path' => CACHE . 'models' . DS,
		'serialize' => ($engine === 'File'),
		'duration' => $duration,
		'mask' => 0777
	));
