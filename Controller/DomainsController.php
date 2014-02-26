<?php
App::uses('AppController', 'Controller');
/**
 * Domains Controller
 *
 * @property Domain $Domain
 */
class DomainsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('domains', $this->Domain->find('all', array('contain' => 'MailList')));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Domain->exists($id)) {
			throw new NotFoundException(__('Invalid domain'));
		}
		$options = array(
			'contain' => array('MailList'),
			'conditions' => array('Domain.' . $this->Domain->primaryKey => $id)
		);
		$this->set('domain', $this->Domain->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Domain->create();
			if ($this->Domain->save($this->request->data)) {
				$this->Session->setFlash(__('The domain has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The domain could not be saved. Please, try again.'));
			}
		}

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
		if (!$this->Domain->exists($id)) {
			throw new NotFoundException(__('Invalid domain'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Domain->save($this->request->data)) {
				$this->Session->setFlash(__('The domain has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The domain could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Domain.' . $this->Domain->primaryKey => $id));
			$this->request->data = $this->Domain->find('first', $options);
		}

		$this->render('form');
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Domain->id = $id;
		if (!$this->Domain->exists()) {
			throw new NotFoundException(__('Invalid domain'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Domain->delete()) {
			$this->Session->setFlash(__('The domain has been deleted.'));
		} else {
			$this->Session->setFlash(__('The domain could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
