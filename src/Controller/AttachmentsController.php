<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Attachments Controller
 *
 * @property \App\Model\Table\AttachmentsTable $Attachments
 */
class AttachmentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Objects', 'Users']
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
    public function view($id = null)
    {
        $attachment = $this->Attachments->get($id, [
            'contain' => ['Objects', 'Users']
        ]);
        $this->set('attachment', $attachment);
        $this->set('_serialize', ['attachment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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
        $objects = $this->Attachments->Objects->find('list', ['limit' => 200]);
        $users = $this->Attachments->Users->find('list', ['limit' => 200]);
        $this->set(compact('attachment', 'objects', 'users'));
        $this->set('_serialize', ['attachment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Attachment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
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
        $objects = $this->Attachments->Objects->find('list', ['limit' => 200]);
        $users = $this->Attachments->Users->find('list', ['limit' => 200]);
        $this->set(compact('attachment', 'objects', 'users'));
        $this->set('_serialize', ['attachment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Attachment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attachment = $this->Attachments->get($id);
        if ($this->Attachments->delete($attachment)) {
            $this->Flash->success(__('The attachment has been deleted.'));
        } else {
            $this->Flash->error(__('The attachment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
