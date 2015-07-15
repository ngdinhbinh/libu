<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Controller\UsersController;
use App\Controller\ProjectsController;
use App\Controller\AttachmentsController;
use App\Controller\TasksFileAttachController;
use App\Controller\CommentsController;
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
        $query = $this->Tasks->find()
                ->select(['tasks.id', 'tasks.name', 'p.id', 'p.name', 'u.id', 'u.name', 'tasks.notification_type', 'tasks.status'])
                ->hydrate(true)
                ->join([
                    'p' => [
                        'table' => 'projects',
                        'type' => 'left',
                        'conditions' => 'p.id = tasks.project_id ',
                    ],
                    'u' => [
                        'table' => 'users',
                        'type' => 'left',
                        'conditions' => 'u.id = tasks.to_user',
                    ]
                ])
                ->where(['tasks.user_id' => $this->Auth->user('id')])
                ->order(['tasks.created_date' => 'DESC']);
        $this->set('tasks', $this->paginate($query));
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
        $this->set('_sub_title', 'Task view');

        $projects = new ProjectsController;
        $this->set('_all_projects', $projects->getbyuserid());

        $users = new UsersController;
        $this->set('to_user', $users->getUser($task->to_user));
        $this->set('cc_user', $users->getUser($task->cc_user));

        $fileAttach = new TasksFileAttachController;
        $this->set('_all_attach_file', $fileAttach->getTaskAttachFile($id));

        $this->set('_id', $id);

        $comments = new CommentsController;
        $this->set("comments", $comments->getcomment($id));

        $this->set("tasksRelate", $this->getTaskRelateProject($task->project_id, $task->id));

        $users = new UsersController;
        $this->set('_all_users', $users->getPublishUser());

        if ($this->request->is('post')) {
            $commentsTable = TableRegistry::get('Comments');
            if ($this->request->data('action') !== NULL && $this->request->data['action'] == 'edit_comment') {
                //Edit comment
                $comment_id = $this->request->data['comment_id'];
                $comment = $commentsTable->get($comment_id);
                $comment->name = $this->request->data['comments'];

                $comment->modified_date = date('Y-m-d H:i:s');
                $commentsTable->save($comment);
            } elseif ($this->request->data('action') !== NULL && $this->request->data['action'] == 'edit_task') {
                $task = $this->Tasks->get($id, [
                    'contain' => []
                ]);
                $task = $this->Tasks->patchEntity($task, $this->request->data);
                $task->name = $this->request->data['name'];
                $task->project_id = $this->request->data['project_id'];
                $task->to_user = $this->request->data['to_user'];
                $task->cc_user = $this->request->data['cc_user'];
                $task->subject = $this->request->data['subject'];
                $task->modified_date = date('Y-m-d H:i:s');
                $this->Tasks->save($task);
            } else {
                //Add comment
                $comment = $commentsTable->newEntity();
                $comment->task_id = $this->request->data['task_id'];
                $comment->user_id = $this->Auth->user('id');
                $comment->name = $this->request->data['comments'];
                $comment->created_date = date('Y-m-d H:i:s');
                $commentsTable->save($comment);
            }

            return $this->redirect(['controller' => 'tasks', 'action' => 'view', $id]);
        }
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
            $task->created_date = date('Y-m-d H:i:s');

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

            if ($task->to_user == '')
                $task->status = 'open';
            else
                $task->status = 'inprogress';
            //$task->status = $this->request->data['status'];


            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));
                //Add attach_id
                if ($this->request->data('attach_id') !== NULL) {
                    $attach_id = $this->request->data['attach_id'];
                    foreach ($attach_id as $att_id) {
                        $TasksFileAttachTable = TableRegistry::get('TasksFileAttach');
                        $fileAttach = $TasksFileAttachTable->newEntity();
                        $fileAttach->user_id = $this->Auth->user('id');
                        $fileAttach->task_id = $task->id;
                        $fileAttach->attachment_id = $att_id;
                        $fileAttach->attach_date = date('Y-m-d H:i:s');
                        $fileAttach->description = '';
                        $TasksFileAttachTable->save($fileAttach);
                    }
                }
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
            $task->id = $id;

            $task->name = $this->request->data['name'];
            $task->project_id = $this->request->data['project_id'];
            $task->to_user = $this->request->data['to_user'];
            $task->cc_user = $this->request->data['cc_user'];
            $task->subject = $this->request->data['subject'];
            $task->modified_date = date('Y-m-d H:i:s');

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
                //Add attach_id
                if ($this->request->data('attach_id') !== NULL) {
                    $attach_id = $this->request->data['attach_id'];
                    foreach ($attach_id as $att_id) {
                        $TasksFileAttachTable = TableRegistry::get('TasksFileAttach');
                        //check if exists
                        $query = $TasksFileAttachTable->find()
                                ->where(['TasksFileAttach.attachment_id' => $att_id, "TasksFileAttach.task_id" => $task->id]);
                        $chk = $query->toArray();
                        if (count($chk) == 0) {
                            $fileAttach = $TasksFileAttachTable->newEntity();
                            $fileAttach->user_id = $this->Auth->user('id');
                            $fileAttach->task_id = $task->id;
                            $fileAttach->attachment_id = $att_id;
                            $fileAttach->attach_date = date('Y-m-d H:i:s');
                            $fileAttach->description = '';
                            $TasksFileAttachTable->save($fileAttach);
                        }
                    }
                }
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
        $this->set('_sub_title', 'Edit task');

        $projects = new ProjectsController;
        $this->set('_all_projects', $projects->getbyuserid());
        $users = new UsersController;
        $this->set('_all_users', $users->getPublishUser());
        $fileAttach = new TasksFileAttachController;
        $this->set('_all_attach_file', $fileAttach->getTaskAttachFile($id));
        $this->set('_id', $id);
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

    public function removeattach() {
        $this->layout = 'ajax';

        $fileattach_id = $this->request->data['fileattach_id'];
        if ($fileattach_id != 0) {//this for upload new
            $TasksFileAttachTable = TableRegistry::get('TasksFileAttach');
            $TasksFileAttach = $TasksFileAttachTable->get($fileattach_id);
            $TasksFileAttachTable->delete($TasksFileAttach);
        }

        $attach_id = $this->request->data['attach_id'];
        $AttachmentsTable = TableRegistry::get('Attachments');
        $Attachments = $AttachmentsTable->get($attach_id);
        if ($AttachmentsTable->delete($Attachments)) {
            $file_url = WWW_ROOT . $Attachments->url;
            unlink($file_url);
        }
        $this->set('response', 'success');
    }
    public function deletecomment(){
        $commentsTable = TableRegistry::get('Comments');
        $comment = $commentsTable->get($this->request->data['comment_id']);
        $commentsTable->delete($comment);
         return $this->redirect(['action' => 'view', $this->request->data['task_id']]);
    }
    public function isAuthorized($user) {
        $action = $this->request->params['action'];
        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'removeattach','deletecomment'])) {
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

    public function getTaskRelateProject($project_id, $exclude_id) {
        $query = $this->Tasks->find()
                ->where(["Tasks.project_id" => $project_id, "Tasks.id NOT IN" => $exclude_id])
                ->order(["Tasks.created_date" => "desc"]);
        return $query->toArray();
    }

}
