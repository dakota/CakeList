<?php
App::uses('AppController', 'Controller');
/**
 * ArchivedMessages Controller
 *
 * @property ArchivedMessage $ArchivedMessage
 * @property PaginatorComponent $Paginator
 */
class ArchivedMessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ArchivedMessage->recursive = 0;
		$this->set('archivedMessages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ArchivedMessage->exists($id)) {
			throw new NotFoundException(__('Invalid archived message'));
		}
		$options = array('conditions' => array('ArchivedMessage.' . $this->ArchivedMessage->primaryKey => $id));
		$this->set('archivedMessage', $this->ArchivedMessage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ArchivedMessage->create();
			if ($this->ArchivedMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The archived message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archived message could not be saved. Please, try again.'));
			}
		}
		$mailLists = $this->ArchivedMessage->MailList->find('list');
		$this->set(compact('mailLists'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ArchivedMessage->exists($id)) {
			throw new NotFoundException(__('Invalid archived message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ArchivedMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The archived message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archived message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ArchivedMessage.' . $this->ArchivedMessage->primaryKey => $id));
			$this->request->data = $this->ArchivedMessage->find('first', $options);
		}
		$mailLists = $this->ArchivedMessage->MailList->find('list');
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
		$this->ArchivedMessage->id = $id;
		if (!$this->ArchivedMessage->exists()) {
			throw new NotFoundException(__('Invalid archived message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ArchivedMessage->delete()) {
			$this->Session->setFlash(__('The archived message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The archived message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
