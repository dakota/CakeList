<?php
App::uses('AppController', 'Controller');
/**
 * OutboundMessages Controller
 *
 * @property OutboundMessage $OutboundMessage
 * @property PaginatorComponent $Paginator
 */
class OutboundMessagesController extends AppController {

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
		$this->OutboundMessage->recursive = 0;
		$this->set('outboundMessages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OutboundMessage->exists($id)) {
			throw new NotFoundException(__('Invalid outbound message'));
		}
		$options = array('conditions' => array('OutboundMessage.' . $this->OutboundMessage->primaryKey => $id));
		$this->set('outboundMessage', $this->OutboundMessage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OutboundMessage->create();
			if ($this->OutboundMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The outbound message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outbound message could not be saved. Please, try again.'));
			}
		}
		$mailLists = $this->OutboundMessage->MailList->find('list');
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
		if (!$this->OutboundMessage->exists($id)) {
			throw new NotFoundException(__('Invalid outbound message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OutboundMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The outbound message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outbound message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OutboundMessage.' . $this->OutboundMessage->primaryKey => $id));
			$this->request->data = $this->OutboundMessage->find('first', $options);
		}
		$mailLists = $this->OutboundMessage->MailList->find('list');
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
		$this->OutboundMessage->id = $id;
		if (!$this->OutboundMessage->exists()) {
			throw new NotFoundException(__('Invalid outbound message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OutboundMessage->delete()) {
			$this->Session->setFlash(__('The outbound message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The outbound message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
