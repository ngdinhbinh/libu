<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity.
 */
class Task extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'project_id' => true,
        'to_user' => true,
        'cc_user' => true,
        'subject' => true,
        'allow_attachment' => true,
        'notification_type' => true,
        'notification_value' => true,
        'user_id' => true,
        'project' => true,
        'user' => true,
        'comments' => true,
    ];
}
