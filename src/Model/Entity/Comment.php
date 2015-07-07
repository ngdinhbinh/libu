<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity.
 */
class Comment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'created_date' => true,
        'task_id' => true,
        'user_id' => true,
        'task' => true,
        'user' => true,
    ];
}
