<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UploadsComponent extends Component {

    public function uploadFiles($file) {
        $folder = "uploads";
        $itemId = null;
        // setup dir names absolute and relative
        $folder_url = WWW_ROOT . $folder;
        $rel_url = $folder;

        // create the folder if it does not exist
        if (!is_dir($folder_url)) {
            mkdir($folder_url);
        }

        // if itemId is set create an item folder
        if ($itemId) {
            // set new absolute folder
            $folder_url = WWW_ROOT . $folder . '/' . $itemId;
            // set new relative folder
            $rel_url = $folder . '/' . $itemId;
            // create directory
            if (!is_dir($folder_url)) {
                mkdir($folder_url);
            }
        }

        // list of permitted file types, this is only images but documents can be added
        //$permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
        // loop through and deal with the files
       
        
            // replace spaces with underscores
            $filename = str_replace(' ', '_', $file['name']);
            // assume filetype is false
            // check filename already exists
            if (!file_exists($folder_url . '/' . $filename)) {
                // create full filename
                $full_url = $folder_url . '/' . $filename;
                $url = $rel_url . '/' . $filename;
                // upload the file
                $success = move_uploaded_file($file['tmp_name'], $url);
            } else {
                // create unique filename and upload file
                ini_set('date.timezone', 'Europe/London');
                $now = date('Y-m-d-His');
                $full_url = $folder_url . '/' . $now . $filename;
                $url = $rel_url . '/' . $now . $filename;
                $success = move_uploaded_file($file['tmp_name'], $url);
            }
            // if upload was successful
            if ($success) {
                // save the url of the file
                $result['file']['url'] = $url;
                $result['file']['type'] = $file['type'];
            } else {
                $result['errors'][] = "Error uploaded $filename. Please try again.";
            }
       
        return $result;
    }

}
