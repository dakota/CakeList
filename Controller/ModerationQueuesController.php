<?php
App::uses('AppController', 'Controller');
/**
 * ModerationQueues Controller
 *
 * @property ModerationQueue $ModerationQueue
 */
class ModerationQueuesController extends AppController {

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function approve($id) {
		$this->ModerationQueue->id = $id;
		if (!$this->ModerationQueue->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}

		$message = $this->ModerationQueue->approve($id);
		$this->Session->setFlash('Message approved');
		$this->redirect([
			'controller' => 'mail_lists',
			'action' => 'view',
			$message['ModerationQueue']['mail_list_id']
		]);
	}
}