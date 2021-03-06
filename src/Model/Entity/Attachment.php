<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attachment Entity.
 */
class Attachment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'attach_type' => true,
        'url' => true,
        'user_id' => true,
        'created_date' => true,
        'user' => true,
    ];
}
