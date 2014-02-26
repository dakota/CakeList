<?php

App::uses('AppShell', 'Console/Command');
App::uses('CakeEmail', 'Network/Email');

/**
 * @property Member $Member
 */
class MailShell extends AppShell {

	public $emailConfig = [];

	public $uses = ['Member', 'MailList'];

	protected $_mailList = [];

	protected $_recipient = [];

	protected function _getSubject() {
		$subject = $this->args['mail']['subject'];
		$prefix = "[{$this->_mailList['MailList']['subject_prefix']}]";
		return strpos($subject, '$prefix') === false ? "$prefix $subject" : $subject;
	}

	protected function _getEmailFormat() {
		if (count($this->args['mail']['body']) > 1) {
			return 'both';
		} elseif (isset($this->args['mail']['body']['text'])) {
			return 'text';
		} else {
			return 'html';
		}
	}

	protected function _getFrom() {
		return ["{$this->_mailList['MailList']['address']}@{$this->_mailList['Domain']['domain']}" => $this->_mailList['MailList']['name']];
	}

	protected function _getTo() {
		return [$this->_recipient['Member']['email_address'] => $this->_recipient['Member']['name']];
	}

	protected function _decode(&$attachment) {
		$attachment['data'] = base64_decode($attachment['data']);
	}

	public function send() {
		$Email = new CakeEmail('mailCatcher');
		$Email->config($this->emailConfig);

		$this->_recipient = $this->Member->read(null, $this->args['recipient']);
		$this->MailList->contain('Domain.domain');
		$this->_mailList = $this->MailList->read(null, $this->args['mailList']);

		if (empty($this->_recipient) || empty($this->_mailList)) {
			return false;
		}

		$Email->to($this->_getTo());
		$Email->from($this->_getFrom());
		$Email->domain($this->_mailList['Domain']['domain']);
		$Email->subject($this->_getSubject());
		$Email->replyTo($this->args['mail']['replyTo']);
		$Email->emailFormat($this->_getEmailFormat());
		$Email->template('mail');
		$Email->viewVars([
			'body' => $this->args['mail']['body']
		]);

		if (!empty($this->args['mail']['attachments'])) {
			array_walk($this->args['mail']['attachments'], array($this, '_decode'));
			$Email->attachments($this->args['mail']['attachments']);
		}

		if ($Email->send()) {
			return true;
		}
	}
}