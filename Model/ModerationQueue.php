<?php
App::uses('AppModel', 'Model');
App::uses('CakeResque.CakeResque', 'Lib');
/**
 * ModerationQueue Model
 *
 * @property MailList $MailList
 */
class ModerationQueue extends AppModel {

	public $useTable = 'moderation_queue';

	public $queueClass = 'CakeResque';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mail_list_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
			),
		),
		'message' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = [
		'MailList' => [
			'counterCache' => true
		]
	];

	public function saveMessage($message, $mailingListId) {
		if (!$this->MailList->exists($mailingListId)) {
			return false;
		}

		$data = array(
			'mail_list_id' => $mailingListId,
			'message' => $message
		);
		$this->create();
		return $this->save($data);
	}

	private function __getBodyParts($parsedMessage) {
		$types = ['text', 'html'];
		$body = [];
		foreach ($types as $type) {
			$message = $parsedMessage->getMessageBody($type);
			if ($message) {
				$body[$type] = $message;
			}
		}

		return $body;
	}

	private function __getAttachments($parsedMessage) {
		$originalAttachments = $parsedMessage->getAttachments();
		$attachments = [];
		foreach ($originalAttachments as $originalAttachment) {
			$attachment = [];
			$attachment['data'] = base64_encode($originalAttachment->getContent());
			$attachment['mimetype'] = $originalAttachment->getContentType();
			if (!empty($originalAttachment->headers['content-id'])) {
				$attachment['contentId'] = str_replace(['<', '>'], '', $originalAttachment->headers['content-id']);
			}

			$attachments[$originalAttachment->getFilename()] = $attachment;
		}

		return $attachments;
	}

	private function __parseEmail($email) {
		if (strpos($email, '<') === false) {
			return $email;
		} else {
			preg_match('/(.*) <(.*@.*)>/', $email, $matches);
			list($original, $name, $email) = $matches;
			$name = trim($name, " \t\n\r\0\x0B\"");
			return [$email => $name];
		}
	}

	public function approve($messageId) {
		$this->id = $messageId;
		if (!$this->exists()) {
			return false;
		}

		$this->contain([
			'MailList.Member',
			'MailList.Domain'
		]);
		$message = $this->read();
		$parsedMessage = new MimeMailParser\Parser();
		$parsedMessage->setText($message['ModerationQueue']['message']);
		$from = $this->__parseEmail($parsedMessage->getHeader('from'));
		$fromAddress = array_keys($from)[0];

		$mail = [
			'subject' => $parsedMessage->getHeader('subject'),
			//Reply to should be the original message sender
			'replyTo' => $from,
			'body' => $this->__getBodyParts($parsedMessage),
			'attachments' => $this->__getAttachments($parsedMessage)
		];

		$recipients = Hash::extract($message, 'MailList.Member.{n}.id');
		$queueClass = $this->queueClass;
		foreach ($message['MailList']['Member'] as $recipient) {
			if ($recipient['email_address'] == $fromAddress) {
				continue;
			}

			$queueClass::enqueue('mail', 'MailShell', [
				'send',
				'recipient' => $recipient['id'],
				'mailList' => $message['MailList']['id'],
				'mail' => $mail
			], true);
		}

		$this->delete($message['ModerationQueue']['id']);
		return $message;
	}
}
