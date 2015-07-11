<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TasksFileAttach Entity.
 */
class TasksFileAttach extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'task_id' => true,
        'attachment_id' => true,
        'attach_date' => true,
        'user_id' => true,
        'description' => true,
        'task' => true,
        'attachment' => true,
        'user' => true,
    ];
}
