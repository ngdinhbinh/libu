<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Controller\TasksFileAttachController;
use Cake\ORM\TableRegistry;
/**
 * Attachments Controller
 *
 * @property \App\Model\Table\AttachmentsTable $Attachments
 */
class AttachmentsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('attachments', $this->paginate($this->Attachments));
        $this->set('_serialize', ['attachments']);
    }

    /**
     * View method
     *
     * @param string|null $id Attachment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $attachment = $this->Attachments->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('attachment', $attachment);
        $this->set('_serialize', ['attachment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $attachment = $this->Attachments->newEntity();
        if ($this->request->is('post')) {
            $attachment = $this->Attachments->patchEntity($attachment, $this->request->data);
            if ($this->Attachments->save($attachment)) {
                $this->Flash->success(__('The attachment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attachment could not be saved. Please, try again.'));
            }
        }
        $users = $this->Attachments->Users->find('list', ['limit' => 200]);
        $this->set(compact('attachment', 'users'));
        $this->set('_serialize', ['attachment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Attachment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $attachment = $this->Attachments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attachment = $this->Attachments->patchEntity($attachment, $this->request->data);
            if ($this->Attachments->save($attachment)) {
                $this->Flash->success(__('The attachment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attachment could not be saved. Please, try again.'));
            }
        }
        $users = $this->Attachments->Users->find('list', ['limit' => 200]);
        $this->set(compact('attachment', 'users'));
        $this->set('_serialize', ['attachment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Attachment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $attachment = $this->Attachments->get($id);
        if ($this->Attachments->delete($attachment)) {
            $this->Flash->success(__('The attachment has been deleted.'));
        } else {
            $this->Flash->error(__('The attachment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function upload() {
        $this->layout = 'ajax';

        $folder = "uploads/" . $this->Auth->user('id');

        // setup dir names absolute and relative
        $folder_url = WWW_ROOT . $folder;
        if (!is_dir($folder_url)) {
            mkdir($folder_url);
        }
        $rel_url = $folder;
        $file = $this->request->data;
        $item = $file['item'];
        $file = $file['images'][0];


        $filename = str_replace(' ', '_', $file['name']);
        // assume filetype is false
        // check filename already exists
        //if (!file_exists($folder_url . '/' . $filename)) {
        // create full filename
        $full_url = $folder_url . '/' . $filename;
        $url = $rel_url . '/' . $filename;
        // upload the file
        $success = move_uploaded_file($file['tmp_name'], $url);
        //} 
//        else {
//            // create unique filename and upload file
//           
//            $now = date('Y-m-d-His');
//            $full_url = $folder_url . '/' . $now . $filename;
//            $url = $rel_url . '/' . $now . $filename;
//            $success = move_uploaded_file($file['tmp_name'], $url);
//        }
        // if upload was successful
        if ($success) {
            //Add to table
            $attachment = $this->Attachments->newEntity();
            $attachment->name = $file['name'];
            $attachment->attach_type = $file['type'];
            $attachment->user_id = $this->Auth->user('id');
            $attachment->url = $url;
            $attachment->created_date = date('Y-m-d H:i:s');
            $attach_result = $this->Attachments->save($attachment);
         
            if ( $this->request->data('task_id')  ) {
               
                $TasksFileAttachTable = TableRegistry::get('TasksFileAttach');
                $fileAttach = $TasksFileAttachTable->newEntity();
                $fileAttach->user_id = $this->Auth->user('id');
                $fileAttach->task_id = $this->request->data['task_id'];
                $fileAttach->attachment_id = $attach_result->id;
                $fileAttach->attach_date = date('Y-m-d H:i:s');
                $this->set('fileacttach', $fileAttach);
                $fileattch_result = $TasksFileAttachTable->save($fileAttach);
                $this->set('taskfileattach_id',$fileattch_result->id);
            }
            // save the url of the file
            $result['attach']['id'] = $attach_result->id;
            $result['attach']['url'] = $url;
            $result['attach']['name'] = $filename;
            $result['attach']['type'] = $file['type'];
            $result['attach']['date'] = $attachment->created_date;
        } else {
            $result['errors'][] = "Error uploaded $filename. Please try again.";
        }
        $this->set('item', $item);
        $this->set('attachinfo', $result);
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];
        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'upload'])) {
            return true;
        }
        // All other actions require an id.
        // Check that the bookmark belongs to the current user.
        $id = $this->request->params['pass'][0];

        $attachments = $this->Attachments->get($id);

        if ($attachments->user_id == $user['id']) {
            return true;
        }
        return parent::isAuthorized($user);
    }

}
