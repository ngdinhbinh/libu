<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SocialProfiles Controller
 *
 * @property \App\Model\Table\SocialProfilesTable $SocialProfiles
 */
class SocialProfilesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'SocialNetworks']
        ];
        $this->set('socialProfiles', $this->paginate($this->SocialProfiles));
        $this->set('_serialize', ['socialProfiles']);
    }

    /**
     * View method
     *
     * @param string|null $id Social Profile id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $socialProfile = $this->SocialProfiles->get($id, [
            'contain' => ['Users', 'SocialNetworks']
        ]);
        $this->set('socialProfile', $socialProfile);
        $this->set('_serialize', ['socialProfile']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $socialProfile = $this->SocialProfiles->newEntity();
        if ($this->request->is('post')) {
            $socialProfile = $this->SocialProfiles->patchEntity($socialProfile, $this->request->data);
            if ($this->SocialProfiles->save($socialProfile)) {
                $this->Flash->success(__('The social profile has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The social profile could not be saved. Please, try again.'));
            }
        }
        $users = $this->SocialProfiles->Users->find('list', ['limit' => 200]);
        $socialNetworks = $this->SocialProfiles->SocialNetworks->find('list', ['limit' => 200]);
        $this->set(compact('socialProfile', 'users', 'socialNetworks'));
        $this->set('_serialize', ['socialProfile']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Social Profile id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $socialProfile = $this->SocialProfiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $socialProfile = $this->SocialProfiles->patchEntity($socialProfile, $this->request->data);
            if ($this->SocialProfiles->save($socialProfile)) {
                $this->Flash->success(__('The social profile has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The social profile could not be saved. Please, try again.'));
            }
        }
        $users = $this->SocialProfiles->Users->find('list', ['limit' => 200]);
        $socialNetworks = $this->SocialProfiles->SocialNetworks->find('list', ['limit' => 200]);
        $this->set(compact('socialProfile', 'users', 'socialNetworks'));
        $this->set('_serialize', ['socialProfile']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Social Profile id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $socialProfile = $this->SocialProfiles->get($id);
        if ($this->SocialProfiles->delete($socialProfile)) {
            $this->Flash->success(__('The social profile has been deleted.'));
        } else {
            $this->Flash->error(__('The social profile could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
