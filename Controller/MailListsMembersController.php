<?php
App::uses('AppController', 'Controller');
/**
 * MailListsMembers Controller
 *
 * @property MailListsMember $MailListsMember
 * @property PaginatorComponent $Paginator
 */
class MailListsMembersController extends AppController {

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
		$this->MailListsMember->recursive = 0;
		$this->set('mailListsMembers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MailListsMember->exists($id)) {
			throw new NotFoundException(__('Invalid mail lists member'));
		}
		$options = array('conditions' => array('MailListsMember.' . $this->MailListsMember->primaryKey => $id));
		$this->set('mailListsMember', $this->MailListsMember->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MailListsMember->create();
			if ($this->MailListsMember->save($this->request->data)) {
				$this->Session->setFlash(__('The mail lists member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mail lists member could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MailListsMember->exists($id)) {
			throw new NotFoundException(__('Invalid mail lists member'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MailListsMember->save($this->request->data)) {
				$this->Session->setFlash(__('The mail lists member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mail lists member could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MailListsMember.' . $this->MailListsMember->primaryKey => $id));
			$this->request->data = $this->MailListsMember->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MailListsMember->id = $id;
		if (!$this->MailListsMember->exists()) {
			throw new NotFoundException(__('Invalid mail lists member'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MailListsMember->delete()) {
			$this->Session->setFlash(__('The mail lists member has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mail lists member could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
