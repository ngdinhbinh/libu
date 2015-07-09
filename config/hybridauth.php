<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Cake\Core\Configure;

$config['HybridAuth'] = [
    'base_url' => 'URL here',
    'providers' => [
        'OpenID' => [ 'enabled' => true ],
        'Twitter' => [ ],
        'Twitter' => [ ],
        'Twitter' => [ ]
    ],
    'debug_mode' => Configure::read('debug'),
    'debug_file' => LOGS . 'hybridauth.log',
];

return $config;
