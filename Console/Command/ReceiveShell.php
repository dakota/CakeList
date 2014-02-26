<?php

App::uses('AppShell', 'Console/Command');

class ReceiveException extends Exception {
}

/**
 * @property Domain $Domain
 */
class ReceiveShell extends AppShell {

/**
 * The raw message
 * @var string
 */
	private $__message;

/**
 * The parsed message
 * @var MimeMailParser\Parser
 */
	private $__Parser;

	private $__mailingList;

	public $inputStream = 'php://stdin';

/**
 * Models that are used
 * @var array
 */
	public $uses = array('Domain', 'ModerationQueue');

	private function __parseMessage() {
		$this->__Parser = new MimeMailParser\Parser();
		$this->__Parser->setText($this->__message);
	}

	private function __getFromAddress() {
		$from = $this->__Parser->getHeader('from');
		if (strpos($from, '<') !== false) {
			preg_match('/<(.*)>/', $from, $match);
			$from = $match[1];
		}

		return $from;
	}

	private function __validMember($memberAddress) {
		$members = Hash::extract($this->__mailingList, 'Member.{n}.email_address');
		return in_array($memberAddress, $members);
	}

/**
 * Receives an incoming message
 * @param  string $message The message in mime/mbox format
 * @return void
 * @throws ReceiveException If the x-original-to header is not found
 */
	public function receive($message) {
		$this->__message = $message;
		$this->__parseMessage();
		$mailingListAddress = $this->__Parser->getHeader('x-original-to');

		if (!$mailingListAddress) {
			throw new ReceiveException('No x-original-to header found. Please ensure that the x-orginal-to header is set by your MTA.');
		}
		$this->__mailingList = $this->Domain->MailList->getList($mailingListAddress);

		if (!$this->__mailingList) {
			throw new ReceiveException("$mailingListAddress does not exist");
		}
		$from = $this->__getFromAddress();

		if (!$this->__validMember($from)) {
			throw new ReceiveException("$from is not a member of $mailingListAddress");
		}

		return $this->ModerationQueue->saveMessage($this->__message, $this->__mailingList['MailList']['id']);
	}

	public function startup() {
		$this->out('CakeList receive shell', 1, Shell::VERBOSE);
	}

	public function main() {
		if (is_string($this->inputStream)) {
			$this->inputStream = fopen($this->inputStream, 'r');
		}

		$message = stream_get_contents($this->inputStream);
		
		return $this->receive($message);
	}
}