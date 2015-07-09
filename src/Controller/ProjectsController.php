<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{
    public $paginate = [
        'contain' => ['Users'],
        'limit' => 5,
        'order' => [
            'Projects.created_date' => 'desc'
        ]
    ];
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('projects', $this->paginate());
        $this->set('_serialize', ['projects']);
        $this->set('_sub_title','All projects');
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Users', 'Tasks']
        ]);
        $this->set('project', $project);
        $this->set('_serialize', ['project']);
	$this->set('_sub_title','Project detail');
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
			$project->user_id = $this->Auth->user('id');
                         $project->created_date = date("Y-m-d H:i:s");
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
        }
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $this->set(compact('project', 'users'));
        $this->set('_serialize', ['project']);
		$this->set('_sub_title','Add project');
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            $project->user_id = $this->Auth->user('id');
           
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
        }
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $this->set(compact('project', 'users'));
        $this->set('_serialize', ['project']);
		$this->set('_sub_title','Edit project');
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user){
		$action = $this->request->params['action'];
		// The add and index actions are always allowed.
		if (in_array($action, ['index', 'add'])) {
			return true;
		}
		// All other actions require an id.
               
		if (empty($this->request->params['pass'][0])) {
                    return false;
		}
		// Check that the bookmark belongs to the current user.
		$id = $this->request->params['pass'][0];
                
		$project = $this->Projects->get($id);
               
		if ($project->user_id == $user['id']) {
                    return true;
		}
		return parent::isAuthorized($user);
    }
    
    public function getbyuserid(){        
        $query = $this->Projects->find()->where( ['Projects.user_id' => $this->Auth->user('id') ] )->order(['Projects.name' =>'ASC']);
     
        return $query->toArray();
    }
}
