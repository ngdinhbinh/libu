<?php

namespace App\Controller;

use App\Controller\AppController;

use ADmad\HybridAuth\Controller\HybridAuthController;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Hybridauth');
      
    }
    public function index() {
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Comments', 'Projects', 'Tasks', 'TasksUser']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function register() {
        $this->layout = 'register';
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            $user->email = $this->request->data['email'];
            $user->password = $this->request->data['password'];
            $user->firstname = $this->request->data['firstname'];
            $user->lastname = $this->request->data['lastname'];
            $user->name = $user->firstname . " " . $user->lastname;
            if ($user->email == '' || $user->password == '' || $user->firstname == '' || $user->lastname == '') {
                $this->Flash->error(__('Please review the fields below and try again.'));
                return;
            }
            $user->register_date = date("Y-m-d h:i:s");
            $user->role = 'member';
            $user->status = 'new';
            $user->activation_key = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
            ;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout() {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function beforeFilter(\Cake\Event\Event $event) {
        $this->Auth->allow(['register', 'logout', 'social_login','social_endpoint']);
    }

    public function getPublishUser() {
        $query = $this->Users->find()->where(['Users.status' => 'active', "Users.id NOT IN" => $this->Auth->user('id') ])->order(['Users.firstname' => 'ASC']);
        return $query->toArray();
    }

    public function social_login($provider) {
        if ($this->Hybridauth->connect($provider)) {
            $this->_successfulHybridauth($provider, $this->Hybridauth->user_profile);
        } else {
            // error
            $this->Session->setFlash($this->Hybridauth->error);
            $this->redirect($this->Auth->loginAction);
        }
    }

    public function social_endpoint($provider = null) {
        $this->Hybridauth->processEndpoint();
    }

    private function _successfulHybridauth($provider, $incomingProfile) {

        // #1 - check if user already authenticated using this provider before
        $this->SocialProfile->recursive = -1;
        $existingProfile = $this->SocialProfile->find('first', array(
            'conditions' => array('social_network_id' => $incomingProfile['SocialProfile']['social_network_id'], 'social_network_name' => $provider)
        ));

        if ($existingProfile) {
            // #2 - if an existing profile is available, then we set the user as connected and log them in
            $user = $this->User->find('first', array(
                'conditions' => array('id' => $existingProfile['SocialProfile']['user_id'])
            ));

            $this->_doSocialLogin($user, true);
        } else {

            // New profile.
            if ($this->Auth->loggedIn()) {
                // user is already logged-in , attach profile to logged in user.
                // create social profile linked to current user
                $incomingProfile['SocialProfile']['user_id'] = $this->Auth->user('id');
                $this->SocialProfile->save($incomingProfile);

                $this->Session->setFlash('Your ' . $incomingProfile['SocialProfile']['social_network_name'] . ' account is now linked to your account.');
                $this->redirect($this->Auth->redirectUrl());
            } else {
                // no-one logged and no profile, must be a registration.
                $user = $this->User->createFromSocialProfile($incomingProfile);
                $incomingProfile['SocialProfile']['user_id'] = $user['User']['id'];
                $this->SocialProfile->save($incomingProfile);

                // log in with the newly created user
                $this->_doSocialLogin($user);
            }
        }
    }

    private function _doSocialLogin($user, $returning = false) {

        if ($this->Auth->login($user['User'])) {
            if ($returning) {
                $this->Session->setFlash(__('Welcome back, ' . $this->Auth->user('username')));
            } else {
                $this->Session->setFlash(__('Welcome to our community, ' . $this->Auth->user('username')));
            }
            $this->redirect($this->Auth->loginRedirect);
        } else {
            $this->Session->setFlash(__('Unknown Error could not verify the user: ' . $this->Auth->user('username')));
        }
    }
    
    public function getUser($user_id){
        $query = $this->Users->find()
                    ->where(["Users.id"=>$user_id]);
        return $query->toArray();
    }
}
