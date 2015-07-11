<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TasksFileAttach Controller
 *
 * @property \App\Model\Table\TasksFileAttachTable $TasksFileAttach
 */
class TasksFileAttachController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tasks', 'Attachments', 'Users']
        ];
        $this->set('tasksFileAttach', $this->paginate($this->TasksFileAttach));
        $this->set('_serialize', ['tasksFileAttach']);
    }

    /**
     * View method
     *
     * @param string|null $id Tasks File Attach id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tasksFileAttach = $this->TasksFileAttach->get($id, [
            'contain' => ['Tasks', 'Attachments', 'Users']
        ]);
        $this->set('tasksFileAttach', $tasksFileAttach);
        $this->set('_serialize', ['tasksFileAttach']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tasksFileAttach = $this->TasksFileAttach->newEntity();
        if ($this->request->is('post')) {
            $tasksFileAttach = $this->TasksFileAttach->patchEntity($tasksFileAttach, $this->request->data);
            if ($this->TasksFileAttach->save($tasksFileAttach)) {
                $this->Flash->success(__('The tasks file attach has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tasks file attach could not be saved. Please, try again.'));
            }
        }
        $tasks = $this->TasksFileAttach->Tasks->find('list', ['limit' => 200]);
        $attachments = $this->TasksFileAttach->Attachments->find('list', ['limit' => 200]);
        $users = $this->TasksFileAttach->Users->find('list', ['limit' => 200]);
        $this->set(compact('tasksFileAttach', 'tasks', 'attachments', 'users'));
        $this->set('_serialize', ['tasksFileAttach']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tasks File Attach id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tasksFileAttach = $this->TasksFileAttach->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tasksFileAttach = $this->TasksFileAttach->patchEntity($tasksFileAttach, $this->request->data);
            if ($this->TasksFileAttach->save($tasksFileAttach)) {
                $this->Flash->success(__('The tasks file attach has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tasks file attach could not be saved. Please, try again.'));
            }
        }
        $tasks = $this->TasksFileAttach->Tasks->find('list', ['limit' => 200]);
        $attachments = $this->TasksFileAttach->Attachments->find('list', ['limit' => 200]);
        $users = $this->TasksFileAttach->Users->find('list', ['limit' => 200]);
        $this->set(compact('tasksFileAttach', 'tasks', 'attachments', 'users'));
        $this->set('_serialize', ['tasksFileAttach']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tasks File Attach id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tasksFileAttach = $this->TasksFileAttach->get($id);
        if ($this->TasksFileAttach->delete($tasksFileAttach)) {
            $this->Flash->success(__('The tasks file attach has been deleted.'));
        } else {
            $this->Flash->error(__('The tasks file attach could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
