<?php
App::uses('AppController', 'Controller');
/**
 * Members Controller
 *
 * @property Member $Member
 */
class MembersController extends AppController {

/**
 * add method
 *
 * @throws NotFoundException
 * @return void
 */
	public function add($mailListId = null) {
		if (!$this->Member->MailList->exists($mailListId)) {
			throw new NotFoundException(__('Invalid mailing list'));
		}

		if ($this->request->is('post')) {
			$this->request->data['MailList']['MailList'] = $mailListId;
			$this->Member->create();
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('The member has been saved.'));
				return $this->redirect(array('action' => 'view', 'controller' => 'mail_lists', $mailListId));
			} else {
				$this->Session->setFlash(__('The member could not be saved. Please, try again.'));
			}
		}
		$mailList = $this->Member->MailList->read(null, $mailListId);
		$this->set(compact('mailList'));
		$this->render('form');
	}

/**
 * add many method
 *
 * @throws NotFoundException
 * @return void
 */
	public function add_many($mailListId = null) {
		if (!$this->Member->MailList->exists($mailListId)) {
			throw new NotFoundException(__('Invalid mailing list'));
		}

		if ($this->request->is('post')) {
			$this->request->data['Member']['mail_list_id'] = $mailListId;
			if ($this->Member->createMembers($this->request->data)) {
				$this->Session->setFlash(__('The members have been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The members could not be saved. Please, try again.'));
			}
		}
		$mailList = $this->Member->MailList->read(null, $mailListId);
		$this->set(compact('mailList'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Member->exists($id)) {
			throw new NotFoundException(__('Invalid member'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('The member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The member could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
			$this->request->data = $this->Member->find('first', $options);
		}
		$mailLists = $this->Member->MailList->find('list');
		$this->set(compact('mailLists'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Member->id = $id;
		if (!$this->Member->exists()) {
			throw new NotFoundException(__('Invalid member'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Member->delete()) {
			$this->Session->setFlash(__('The member has been deleted.'));
		} else {
			$this->Session->setFlash(__('The member could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
