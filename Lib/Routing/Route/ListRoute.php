<?php

App::uses('CakeRoute', 'Routing/Route');
App::uses('ClassRegistry', 'Utility');

class ListRoute extends CakeRoute {

	private function __loadDomainList() {
		$domains = Cache::read('domains');
		if (empty($domains)) {
			$Domain = ClassRegistry::init('Domain');
			$domains = $Domain->find('list', array(
				'fields' => array('Domain.id', 'Domain.domain')
			));
			Cache::write('domains', $domains);
		}

		return $domains;
	}

	private function __loadMailList() {
		$mailLists = Cache::read('mailLists');
		if (empty($mailLists)) {
			$MailList = ClassRegistry::init('MailList');
			$mailLists = $MailList->find('list', array(
				'fields' => array('MailList.id', 'MailList.address', 'Domain.domain'),
				'contain' => array('Domain')
			));
			Cache::write('mailLists', $mailLists);
		}

		return $mailLists;
	}

	private function __matchDomainName($url) {
		$domains = $this->__loadDomainList();
		if (isset($domains[$url[0]])) {
			$url['domainName'] = $domains[$url[0]];
			unset($url[0]);
			return $url;
		}

		return false;
	}

	private function __matchMailList($url) {
		$mailLists = $this->__loadMailList();
		foreach ($mailLists as $domainName => $mailList) {
			if ($mailList[$url[0]]) {
				$url['mailingList'] = $mailList[$url[0]];
				$url['domainName'] = $domainName;
				unset($url[0]);
				return $url;
			}
		}
	}

	private function __routeMatches($url) {
		return $url['controller'] == $this->defaults['controller'] && $url['action'] == $this->defaults['action'];
	}

	public function parse($url) {
		$params = parent::parse($url);
		if (empty($params)) {
			return false;
		}

		if (isset($params['mailingList']) && isset($params['domainName'])) {
			$mailLists = $this->__loadMailList();
			if (isset($mailLists[$params['domainName']])) {
				$mailLists = array_flip($mailLists[$params['domainName']]);
				if (isset($mailLists[$params['mailingList']])) {
					$params['pass'][0] = $mailLists[$params['mailingList']];
					return $params;
				}
			}
		}

		if (isset($params['domainName'])) {
			$domains = array_flip($this->__loadDomainList());
			if (isset($domains[$params['domainName']])) {
				$params['pass'][0] = $domains[$params['domainName']];
				return $params;
			}
		}

		return false;
	}

	public function match($url) {
		if ($this->__routeMatches($url) && $url['controller'] == 'domains' && $url['action'] == 'view' && !empty($url[0])) {
			$url = $this->__matchDomainName($url);
		} elseif ($this->__routeMatches($url) && $url['controller'] == 'mail_lists' && $url['action'] == 'view' && !empty($url[0])) {
			$url = $this->__matchMailList($url);
		} elseif ($this->__routeMatches($url) && $url['controller'] == 'mail_lists' && $url['action'] == 'add' && !empty($url[0])) {
			$url = $this->__matchDomainName($url);
		} elseif ($this->__routeMatches($url) && $url['controller'] == 'members' && $url['action'] == 'add' && !empty($url[0])) {
			$url = $this->__matchMailList($url);
		} elseif ($this->__routeMatches($url) && $url['controller'] == 'members' && $url['action'] == 'add_many' && !empty($url[0])) {
			$url = $this->__matchMailList($url);
		}

		if ($url) {
			return parent::match($url);
		}
		return false;
	}
}