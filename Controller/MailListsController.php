<?php
App::uses('AppController', 'Controller');
/**
 * MailLists Controller
 *
 * @property MailList $MailList
 */
class MailListsController extends AppController {

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MailList->exists($id)) {
			throw new NotFoundException(__('Invalid mail list'));
		}
		$options = array(
			'contain' => array(
				'Domain',
				'Member',
				'ModerationQueue'
			),
			'conditions' => array('MailList.' . $this->MailList->primaryKey => $id)
		);
		$this->set('mailList', $this->MailList->find('first', $options));
	}

/**
 * add method
 *
 * @throws NotFoundException
 * @return void
 */
	public function add($domainId = null) {
		if (!$this->MailList->Domain->exists($domainId)) {
			throw new NotFoundException(__('Invalid domain'));
		}

		if ($this->request->is('post')) {
			$this->request->data['MailList']['domain_id'] = $domainId;
			$this->MailList->create();
			if ($this->MailList->save($this->request->data)) {
				$this->Session->setFlash(__('The mail list has been saved.'));
				return $this->redirect(array('controller' => 'domains', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mail list could not be saved. Please, try again.'));
			}
		}
		$domain = $this->MailList->Domain->read(null, $domainId);
		$this->set(compact('domain'));

		$this->render('form');
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MailList->exists($id)) {
			throw new NotFoundException(__('Invalid mail list'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MailList->save($this->request->data)) {
				$this->Session->setFlash(__('The mail list has been saved.'));
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The mail list could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MailList.' . $this->MailList->primaryKey => $id));
			$this->request->data = $this->MailList->find('first', $options);
		}
		$domains = $this->MailList->Domain->find('list');
		$members = $this->MailList->Member->find('list');
		$this->set(compact('domains', 'members'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MailList->id = $id;
		if (!$this->MailList->exists()) {
			throw new NotFoundException(__('Invalid mail list'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MailList->delete()) {
			$this->Session->setFlash(__('The mail list has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mail list could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'domains', 'action' => 'index'));
	}
}
