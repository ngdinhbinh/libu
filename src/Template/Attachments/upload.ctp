<?php

$fileType = 'doc';
if (strpos($attachinfo['attach']['type'], "image") > -1)
    $fileType = 'img';

$contentHtml = '<div class="fileupload-container">';
$contentHtml .= '<input type="hidden" value="' . $attachinfo['attach']['id'] . '"  name="attach_id[]" />';
$contentHtml .= ' <a target="_blank" href="' . $this->request->webroot . 'webroot/' . $attachinfo['attach']['url'] . '">';
if ($fileType == 'img') {
    $contentHtml .= '<img src="' . $this->request->webroot . 'webroot/' . $attachinfo['attach']['url'] . '" >';
} else {
    $contentHtml .= ' <span class="file-attach  ' . $fileType . '"></span>';
}

$contentHtml .='    </a>
</div>
<div class="attach-info">
    <span class="attach-name">' . $attachinfo['attach']['name'] . '</span>
    <input type="hidden" value="' . $attachinfo['attach']['id'] . '" />
    <span class="attach-delete" title="remove" onclick="remove_attach(this)"></span>';
if (isset($taskfileattach_id))
    $contentHtml .='<input type="hidden" value="' . $taskfileattach_id . '" id="fileattach_id" />';
else
    $contentHtml .='<input type="hidden" value="0" id="fileattach_id" />';
$contentHtml .='</div>';
echo json_encode(array(
    'item' => $item,
    'content' => $contentHtml
));
