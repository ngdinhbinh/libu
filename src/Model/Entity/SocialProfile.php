<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SocialProfile Entity.
 */
class SocialProfile extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'social_network_name' => true,
        'social_network_id' => true,
        'email' => true,
        'display_name' => true,
        'first_name' => true,
        'last_name' => true,
        'link' => true,
        'picture' => true,
        'status' => true,
        'user' => true,
        'social_network' => true,
    ];
}
