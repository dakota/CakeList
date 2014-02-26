<?php

App::uses('ShellDispatcher', 'Console');
App::uses('MailShell', 'Console/Command');
App::uses('AbstractTransport', 'Network/Email');

/**
 * DebugCompTransport class
 *
 * @package       Cake.Test.Case.Controller.Component
 */
class DebugCompTransport extends AbstractTransport {

/**
 * Last email
 *
 * @var string
 */
	public static $lastEmail = null;

/**
 * Send mail
 *
 * @params object $email CakeEmail
 * @return boolean
 */
	public function send(CakeEmail $email) {
		$email->addHeaders(array('Date' => MailShellTest::$sentDate));
		$headers = $email->getHeaders(array_fill_keys(array('from', 'replyTo', 'readReceipt', 'returnPath', 'to', 'cc', 'bcc', 'subject'), true));
		$to = $headers['To'];
		$subject = $headers['Subject'];
		unset($headers['To'], $headers['Subject']);

		$message = implode("\n", $email->message());

		$last = '<pre>';
		$last .= sprintf("%s %s\n", 'To:', $to);
		$last .= sprintf("%s %s\n", 'From:', $headers['From']);
		$last .= sprintf("%s %s\n", 'Subject:', $subject);
		$last .= sprintf("%s\n\n%s", 'Header:', $this->_headersToString($headers, "\n"));
		$last .= sprintf("%s\n\n%s", 'Message:', $message);
		$last .= '</pre>';

		self::$lastEmail = $last;

		return true;
	}

}

/**
 * TestMessageShell
 *
 */
class MailShellTest extends CakeTestCase {

	public $message = [
		'recipient' => '52f893df-e0b4-49a8-ad66-43e4f6570d8e',
		'mailList' => '52f892d2-0d08-4c82-b685-4377f6570d8e',
		'mail' => [
			'subject' => 'Test email',
			'replyTo' => ['testguy@example.com' => 'Test Guy'],
			'body' => [
				'text' => 'Test text',
				'html' => '<strong>Test html</strong>'
			],
			'attachments' => []
		]
	];

	public $data = 'UEsDBBQAAAAIAAdeWkTbDHGfMAAAADIAAAAIABwAdGVzdC50eHRVVAkAA124DVNeuA1TdXgLAAEE6AMAAAToAwAAc1QozswtyElVKEmtKFFIywSx8oGc4hKFxJKSxOSM1NzUvJJihcw8hdTcxMycYj0AUEsBAh4DFAAAAAgAB15aRNsMcZ8wAAAAMgAAAAgAGAAAAAAAAQAAALaBAAAAAHRlc3QudHh0VVQFAANduA1TdXgLAAEE6AMAAAToAwAAUEsFBgAAAAABAAEATgAAAHIAAAAAAA==';

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.domain',
		'app.mail_list',
		'app.moderation_queue',
		'app.archived_message',
		'app.member',
		'app.mail_lists_member'
	);

/**
 * sentDate
 *
 * @var string
 */
	public static $sentDate = null;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$out = $this->getMock('ConsoleOutput', array(), array(), '', false);
		$in = $this->getMock('ConsoleInput', array(), array(), '', false);

		$this->Shell = $this->getMock(
			'MailShell',
			array('in', 'out', 'hr', 'createFile', 'error', 'err', '_stop', '_showInfo'),
			array($out, $out, $in));

		$this->Shell->emailConfig = [
			'transport' => 'DebugComp'
		];
		self::$sentDate = date(DATE_RFC2822);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->Dispatcher, $this->Shell);
	}

	protected function _genericAsserts() {
		$this->assertContains('To: Test Guy <testguy@example.com>', DebugCompTransport::$lastEmail);
		$this->assertContains('From: Test mailing list <test@example.com>', DebugCompTransport::$lastEmail);
		$this->assertContains('Subject: [Test mail] Test email', DebugCompTransport::$lastEmail);
		$this->assertContains('Reply-To: Test Guy <testguy@example.com>', DebugCompTransport::$lastEmail);
		$this->assertContains('X-Mailer: CakeList', DebugCompTransport::$lastEmail);
	}

	public function testSendWithTextMail() {
		$this->Shell->args = $this->message;
		unset($this->Shell->args['mail']['body']['html']);

		$this->Shell->send();

		$this->_genericAsserts();
		$this->assertNotContains('Content-Type: text/html; charset=UTF-8', DebugCompTransport::$lastEmail);
		$this->assertContains('Content-Type: text/plain; charset=UTF-8', DebugCompTransport::$lastEmail);
		$this->assertContains('Test text', DebugCompTransport::$lastEmail);
	}

	public function testSendWithHtmlMail() {
		$this->Shell->args = $this->message;
		unset($this->Shell->args['mail']['body']['text']);

		$date = self::$sentDate;

		$this->Shell->send();
		$this->_genericAsserts();

		$this->assertContains('Content-Type: text/html; charset=UTF-8', DebugCompTransport::$lastEmail);
		$this->assertNotContains('Content-Type: text/plain; charset=UTF-8', DebugCompTransport::$lastEmail);
		$this->assertContains('<strong>Test html</strong>', DebugCompTransport::$lastEmail);
	}

	public function testSendWithBothMail() {
		$this->Shell->args = $this->message;

		$this->Shell->send();
		$this->_genericAsserts();

		$this->assertContains('Content-Type: multipart/mixed;', DebugCompTransport::$lastEmail);
		$this->assertContains('Content-Type: text/plain; charset=UTF-8', DebugCompTransport::$lastEmail);
		$this->assertContains('Content-Type: text/html; charset=UTF-8', DebugCompTransport::$lastEmail);
		$this->assertContains('Test text', DebugCompTransport::$lastEmail);
		$this->assertContains('<strong>Test html</strong>', DebugCompTransport::$lastEmail);
	}

	public function testSendWithAttachment() {
		$this->Shell->args = $this->message;
		$this->Shell->args['mail']['attachments'] = [
			'test.zip' => [
				'mimetype' => 'application/zip',
				'contentId' => 'abcd',
				'data' => base64_decode($this->data)
			]
		];

		$this->Shell->send();
		$this->_genericAsserts();

		$this->assertContains('Content-Type: multipart/mixed;', DebugCompTransport::$lastEmail);
		$this->assertContains('Content-Type: text/plain; charset=UTF-8', DebugCompTransport::$lastEmail);
		$this->assertContains('Content-Type: text/html; charset=UTF-8', DebugCompTransport::$lastEmail);
		$this->assertContains('Test text', DebugCompTransport::$lastEmail);
		$this->assertContains('<strong>Test html</strong>', DebugCompTransport::$lastEmail);

		$this->assertContains('Content-Type: multipart/related', DebugCompTransport::$lastEmail);
		$this->assertContains('Content-ID: <abcd>', DebugCompTransport::$lastEmail);
		$this->assertContains('Content-Type: application/zip', DebugCompTransport::$lastEmail);

		$this->assertContains(substr($this->data, 0, 50), DebugCompTransport::$lastEmail);
	}
}
