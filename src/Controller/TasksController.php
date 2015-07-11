<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Controller\UsersController;
use App\Controller\ProjectsController;
use App\Controller\AttachmentsController;
use Cake\ORM\TableRegistry;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController {

    public $paginate = [
        'contain' => ['Users'],
        'limit' => 5,
        'order' => [
            'Tasks.created_date' => 'desc'
        ]
    ];

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Uploads');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('tasks', $this->paginate());
        $this->set('_serialize', ['tasks']);
        $this->set('_sub_title', "All tasks");
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $task = $this->Tasks->get($id, [
            'contain' => ['Projects', 'Users', 'Comments']
        ]);
        $this->set('task', $task);
        $this->set('_serialize', ['task']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);



            $task->user_id = $this->Auth->user('id');
            $task->name = $this->request->data['name'];
            $task->project_id = $this->request->data['project_id'];
            $task->to_user = $this->request->data['to_user'];
            $task->cc_user = $this->request->data['cc_user'];
            $task->subject = $this->request->data['subject'];
            $task->notification_type = $this->request->data['notification_type'];
            if ($task->notification_type == 'weekly') {
                $notification_value = $this->request->data['notification_value_weekly'];
                $notification_value = implode(",", $notification_value);
            } elseif ($task->notification_type == 'monthly') {
                $notification_value = $this->request->data['_notification_value_monthly'];
            } elseif ($task->notification_type == 'dates') {
                $notification_value = $this->request->data['_notification_value_date'];
            } else {
                $notification_value = "";
            }
            $task->notification_value = $notification_value;
            $task->notification_time = strtotime($this->request->data['notification_time']);
            $task->status = $this->request->data['status'];
            

            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
        $projects = $this->Tasks->Projects->find('list', ['limit' => 200]);
        $users = $this->Tasks->Users->find('list', ['limit' => 200]);
        $this->set(compact('task', 'projects', 'users'));
        $this->set('_serialize', ['task']);
        $this->set('_sub_title', 'Add task');
        //Upload file

        $projects = new ProjectsController;
        $this->set('_all_projects', $projects->getbyuserid());
        $users = new UsersController;
        $this->set('_all_users', $users->getPublishUser());
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $task = $this->Tasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
        $projects = $this->Tasks->Projects->find('list', ['limit' => 200]);
        $users = $this->Tasks->Users->find('list', ['limit' => 200]);
        $this->set(compact('task', 'projects', 'users'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];
        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add'])) {
            return true;
        }
        // All other actions require an id.
        // Check that the bookmark belongs to the current user.
        $id = $this->request->params['pass'][0];

        $task = $this->Tasks->get($id);

        if ($task->user_id == $user['id']) {
            return true;
        }
        return parent::isAuthorized($user);
    }
}
