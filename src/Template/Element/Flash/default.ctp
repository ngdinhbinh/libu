<?php
$class = 'alert alert-danger';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="<?= h($class) ?>">
     <button class="close" data-dismiss="alert" type="button">×</button>
<?= h($message) ?></div>
