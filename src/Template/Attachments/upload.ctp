<?php
$fileType = 'doc';
if( strpos( $attachinfo['attach']['type'], "image" ) > -1 )
    $fileType = 'img';
    
$contentHtml = '<div class="fileupload-container">';
$contentHtml .= '<input type="hidden" value="'.$attachinfo['attach']['id'].'"  name="attach_id[]" />';
$contentHtml .=   ' <a target="_blank" href="'. $this->request->webroot.'webroot/'.$attachinfo['attach']['url'].'">';
if( $fileType == 'img' ){
    $contentHtml .= '<img src="'. $this->request->webroot.'webroot/'.$attachinfo['attach']['url'].'" >';
}else{
    $contentHtml .= ' <span class="file-attach  '.$fileType.'"></span>';
}

$contentHtml .='    </a>
</div>
<div class="attach-info">
    <span class="attach-name">'.$attachinfo['attach']['name'].'</span>
    <span class="attach-delete" title="remove" onclick="javascript: alert('.$attachinfo['attach']['id'].')"></span>
</div>';
echo json_encode(array(
            'item' => $item,
            'content' => $contentHtml
));
