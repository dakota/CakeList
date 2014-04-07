<?php

App::uses('AppShell', 'Console/Command');
App::uses('ConnectionManager', 'Model');

/**
 */
class SetupShell extends AppShell {

	public $postfixConfig = [];

	public $uses = ['Domain'];

	protected function _readPostfixConfig() {
		$configVariables = [
			'alias_maps',
			'virtual_mailbox_maps'
		];

		foreach ($configVariables as $configVariable) {
			$inflected = Inflector::variable($configVariable);
			$this->postfixConfig[$inflected] = explode(',', trim(str_replace($configVariable . ' =', '', shell_exec('postconf ' . $configVariable))));
			$this->postfixConfig[$inflected] = array_map('trim', $this->postfixConfig[$inflected]);
		}
	}

	protected function _baseConfig($dbConfig) {
		return <<<BASECFG
user = {$dbConfig['login']}
password = {$dbConfig['password']}
dbname = {$dbConfig['database']}
hosts = {$dbConfig['host']}
BASECFG;
	}

	protected function _writeVirtualDomainConfig($configDirectory, $baseConfig) {
		$filename = 'cakelist_virtual_domain_map.cf';
		$config = $baseConfig;
		$config .= "\nquery = ";
		$this->Domain->Behaviors->attach('Search.Searchable');
		$query = $this->Domain->getQuery('all', [
			'fields' => ['Domain.domain'],
			'conditions' => [
				'Domain.active' => true,
				'Domain.domain' => '%s'
			]
		]);
		$config .= $query;
		debug($config);
	}

	protected function _writeConfigFiles() {
		$configDirectory = new Folder($this->params['path'], true);
		$db = ConnectionManager::getDataSource($this->params['connection']);
		$dbConfig = $db->config;
		$baseConfig = $this->_baseConfig($dbConfig);

		$this->_writeVirtualDomainConfig($configDirectory, $baseConfig);
	}

	public function startup() {
		$version = file_get_contents(APP . 'VERSION');
		$this->out(__('<info>Welcome to CakeList %s Setup</info>', 'v' . $version));
		$this->hr();
	}

	public function main() {
		$postfix = $this->in(__('Do you use Postfix as your MTA?'), array('y', 'n'), 'y');
		if ($postfix !== 'y') {
			$this->out('<warning>CakeList currently only supports Postfix</warning>');
			$this->_stop(1);
		}

		$this->out('<info>Reading your exisiting Postfix config</info>', 1, Shell::VERBOSE);
		$this->_readPostfixConfig();

		$this->_writeConfigFiles();
	}

/**
 * get the option parser
 *
 * @return void
 */
	public function getOptionParser() {
		$connection = array(
			'short' => 'c',
			'help' => __('Set the db config to use.'),
			'default' => 'default'
		);
		$path = array(
			'help' => __('Path to write config too'),
			'default' => APP . 'Postfix'
		);

		$parser = parent::getOptionParser();
		$parser->description(
			__d('cake_console', 'The Schema Shell generates a schema object from the database and updates the database from the schema.')
		)->addOptions(compact('path', 'connection'));
		return $parser;
	}
}