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
}
