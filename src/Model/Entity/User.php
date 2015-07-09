<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'firstname' => true,
        'lastname' => true,
        'email' => true,
        'password' => true,
        'register_date' => true,
        'activation_key' => true,
        'activation_date' => true,
        'status' => true,
        'role' => true,
        'comments' => true,
        'projects' => true,
        'tasks' => true,
        'tasks_user' => true,
    ];
	protected function _setPassword($value)
	{
		$hasher = new DefaultPasswordHasher();
		return $hasher->hash($value);
	}
        public function createFromSocialProfile($incomingProfile){
	
		// check to ensure that we are not using an email that already exists
		$existingUser = $this->find('first', array(
			'conditions' => array('email' => $incomingProfile['SocialProfile']['email'])));
		
		if($existingUser){
			// this email address is already associated to a member
			return $existingUser;
		}
		
		// brand new user
		$socialUser['User']['email'] = $incomingProfile['SocialProfile']['email'];
		$socialUser['User']['username'] = str_replace(' ', '_',$incomingProfile['SocialProfile']['display_name']);
		$socialUser['User']['role'] = 'bishop'; // by default all social logins will have a role of bishop
		$socialUser['User']['password'] = date('Y-m-d h:i:s'); // although it technically means nothing, we still need a password for social. setting it to something random like the current time..
		$socialUser['User']['created'] = date('Y-m-d h:i:s');
		$socialUser['User']['modified'] = date('Y-m-d h:i:s');
		
		// save and store our ID
		$this->save($socialUser);
		$socialUser['User']['id'] = $this->id;
		
		return $socialUser;
		
	
	}
}
