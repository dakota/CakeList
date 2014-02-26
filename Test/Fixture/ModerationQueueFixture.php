<?php
/**
 * ModerationQueueFixture
 *
 */
class ModerationQueueFixture extends CakeTestFixture {

	public $table = 'moderation_queue';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mail_list_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'message' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mail_list_id' => array('column' => 'mail_list_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 'mail-test',
			'mail_list_id' => '52f892d2-0d08-4c82-b685-4377f6570d8e',
			'message' => "From testguy@example.com Wed Aug 28 00:00:00 2013
Return-Path: <testguy@example.com>
MIME-Version: 1.0
From: \"Test Guy\" <testguy@example.com>
Subject: Test Message
To: lists@example.com
x-original-to: test@example.com
Reply-To: test@example.com
Date: Wed, 28 Feb 2013 00:00:00 +1200 (UTC)
Content-Type: multipart/related; boundary=\"=_mixed 00360F4842257C8B_=\"

--=_mixed 00360F4842257C8B_=
Content-Type: multipart/alternative; boundary=\"=_alternative 00360F4842257C8B_=\"


--=_alternative 00360F4842257C8B_=
Content-Type: text/plain; charset=\"UTF-8\"

The most worth-while thing is to try to put happiness into the lives of 
others.
	-- Baden Powell
--=_alternative 00360F4842257C8B_=
Content-Type: text/html; charset=\"UTF-8\"

<blockquote>
<p>The most worth-while thing is to try to put happiness into the lives of others.</p>
<p>-- Baden Powell</p>
</blockquote>
--=_alternative 00360F4842257C8B_=--
--=_mixed 00360F4842257C8B_=
Content-Type: text/plain; name=\"test.txt\"
Content-Disposition: attachment; filename=\"test.txt\"
Content-Transfer-Encoding: quoted-printable

A simple text file to test attachments in emails.=
--=_mixed 00360F4842257C8B_=
Content-Type: application/zip; name=\"test.zip\"
Content-Disposition: inline; filename=\"test.zip\"
Content-ID: <abcd>
Content-Transfer-Encoding: base64

UEsDBBQAAAAIAAdeWkTbDHGfMAAAADIAAAAIABwAdGVzdC50eHRVVAkAA124DVNeuA1TdXgLAAEE
6AMAAAToAwAAc1QozswtyElVKEmtKFFIywSx8oGc4hKFxJKSxOSM1NzUvJJihcw8hdTcxMycYj0A
UEsBAh4DFAAAAAgAB15aRNsMcZ8wAAAAMgAAAAgAGAAAAAAAAQAAALaBAAAAAHRlc3QudHh0VVQF
AANduA1TdXgLAAEE6AMAAAToAwAAUEsFBgAAAAABAAEATgAAAHIAAAAAAA==

--=_mixed 00360F4842257C8B_=--
",
			'created' => '2014-02-10 10:54:55',
			'modified' => '2014-02-10 10:54:55'
		)
	);

}