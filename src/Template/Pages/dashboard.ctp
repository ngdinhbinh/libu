<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

$cakeDescription = ' LIBU';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Dashboard - 
            <?= $cakeDescription ?>
        </title>
        <?= $this->Html->meta('icon') ?>
        <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css"/>
        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('font-awesome.min.css') ?>
        <?= $this->Html->css('se7en-font.css') ?>
        <?= $this->Html->css('isotope.css') ?>
        <?= $this->Html->css('jquery.fancybox.css') ?>
        <?= $this->Html->css('fullcalendar.css') ?>
        <?= $this->Html->css('select2.css') ?>
        <?= $this->Html->css('morris.css') ?>
        <?= $this->Html->css('datatables.css') ?>
        <?= $this->Html->css('datepicker.css') ?>
        <?= $this->Html->css('timepicker.css') ?>
        <?= $this->Html->css('colorpicker.css') ?>
        <?= $this->Html->css('bootstrap-switch.css') ?>
        <?= $this->Html->css('bootstrap-editable.css') ?>
        <?= $this->Html->css('daterange-picker.css') ?>
        <?= $this->Html->css('typeahead.css') ?>
        <?= $this->Html->css('summernote.css') ?>
        <?= $this->Html->css('ladda-themeless.min.css') ?>
        <?= $this->Html->css('social-buttons.css') ?>
        <?= $this->Html->css('pygments.css') ?>
        <?= $this->Html->css('style.css') ?>
        <?= $this->Html->css('jquery.fileupload-ui.css') ?>
        <?= $this->Html->css('dropzone.css') ?>


        <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>

        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('raphael.min.js') ?>
        <?= $this->Html->script('selectivizr-min.js') ?>
        <?= $this->Html->script('jquery.mousewheel.js') ?>
        <?= $this->Html->script('jquery.vmap.min.js') ?>
        <?= $this->Html->script('jquery.vmap.sampledata.js') ?>
        <?= $this->Html->script('jquery.vmap.world.js') ?>
        <?= $this->Html->script('jquery.bootstrap.wizard.js') ?>
        <?= $this->Html->script('fullcalendar.min.js') ?>
        <?= $this->Html->script('gcal.js') ?>
        <?= $this->Html->script('jquery.dataTables.min.js') ?>
        <?= $this->Html->script('datatable-editable.js') ?>
        <?= $this->Html->script('jquery.easy-pie-chart.js') ?>
        <?= $this->Html->script('excanvas.min.js') ?>
        <?= $this->Html->script('jquery.isotope.min.js') ?>
        <?= $this->Html->script('isotope_extras.js') ?>
        <?= $this->Html->script('modernizr.custom.js') ?>
        <?= $this->Html->script('jquery.fancybox.pack.js') ?>
        <?= $this->Html->script('select2.js') ?>
        <?= $this->Html->script('styleswitcher.js') ?>
        <?= $this->Html->script('wysiwyg.js') ?>  
        <?= $this->Html->script('typeahead.js') ?>	
        <?= $this->Html->script('summernote.min.js') ?>
        <?= $this->Html->script('jquery.inputmask.min.js') ?>
        <?= $this->Html->script('jquery.validate.js') ?>
        <?= $this->Html->script('bootstrap-fileupload.js') ?>
        <?= $this->Html->script('bootstrap-datepicker.js') ?>
        <?= $this->Html->script('bootstrap-timepicker.js') ?>
        <?= $this->Html->script('bootstrap-colorpicker.js') ?>
        <?= $this->Html->script('bootstrap-switch.min.js') ?>
        <?= $this->Html->script('typeahead.js') ?>
        <?= $this->Html->script('spin.min.js') ?>
        <?= $this->Html->script('ladda.min.js') ?>
        <?= $this->Html->script('moment.js') ?>
        <?= $this->Html->script('mockjax.js') ?>
        <?= $this->Html->script('bootstrap-editable.min.js') ?>
        <?= $this->Html->script('xeditable-demo-mock.js') ?>
        <?= $this->Html->script('xeditable-demo.js') ?>
        <?= $this->Html->script('address.js') ?>
        <?= $this->Html->script('daterange-picker.js') ?>
        <?= $this->Html->script('date.js') ?>
        <?= $this->Html->script('morris.min.js') ?>
        <?= $this->Html->script('skycons.js') ?>
        <?= $this->Html->script('fitvids.js') ?>
        <?= $this->Html->script('jquery.sparkline.min.js') ?>
        <?= $this->Html->script('dropzone.js') ?>
        <?= $this->Html->script('main.js') ?>
        <?= $this->Html->script('respond.js') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <?php
        $page_request = $this->request;
        $params = $page_request->params;
        $thisController = strtolower($params['controller']);
        $thisAction = strtolower($params['action']);
        ?>
</head>
<body class="page-header-fixed bg-1 sidebar-nav">

        <div class="modal-shiftfix">
            <!-- Navigation -->
            <div class="navbar navbar-fixed-top scroll-hide" style="overflow: visible;">
                <div class="container-fluid top-bar">
                    <div class="pull-right">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown notifications hidden-xs">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-flag"></span>
                                    <div class="sr-only">
                                        Notifications
                                    </div>
                                    <p class="counter">
                                        4
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">
                                            <div class="notifications label label-info">
                                                New
                                            </div>
                                            <p>
                                                New user added: Jane Smith
                                            </p></a>

                                    </li>
                                    <li><a href="#">
                                            <div class="notifications label label-info">
                                                New
                                            </div>
                                            <p>
                                                Sales targets available
                                            </p></a>

                                    </li>
                                    <li><a href="#">
                                            <div class="notifications label label-info">
                                                New
                                            </div>
                                            <p>
                                                New performance metric added
                                            </p></a>

                                    </li>
                                    <li><a href="#">
                                            <div class="notifications label label-info">
                                                New
                                            </div>
                                            <p>
                                                New growth data available
                                            </p></a>

                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown messages hidden-xs">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-envelope"></span>
                                    <div class="sr-only">
                                        Messages
                                    </div>
                                    <p class="counter">
                                        3
                                    </p>
                                </a>
                                <ul class="dropdown-menu messages">
                                    <li><a href="#">
                                            <img width="34" height="34" src="">Could we meet today? I wanted...</a>
                                    </li>
                                    <li><a href="#">
                                            <img width="34" height="34" src="">Important data needs your analysis...</a>
                                    </li>
                                    <li><a href="#">
                                            <img width="34" height="34" src="">Buy Se7en today, it's a great theme...</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <img width="34" height="34" src=""><?php 
                                    echo $userData['firstname'] . " " . $userData['lastname'];
                                      ?><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">
                                            <i class="fa fa-user"></i>My Account</a>
                                    </li>
                                    <li><a href="#">
                                            <i class="fa fa-gear"></i>Account Settings</a>
                                    </li>
                                    <li>
                                        <a href="<?= $this->Url->build([ "controller" => "users", "action" => "logout"]); ?>">
                                            <i class="fa fa-sign-out"></i>Logout
                                        </a>

                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <a class="logo" href="index.html">libu</a>
                    <form class="navbar-form form-inline col-lg-2 hidden-xs">
                        <input class="form-control" placeholder="Search" type="text">
                    </form>
                </div>
                <div class="container-fluid main-nav clearfix">
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li>
                                <a href="index.html"><span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
                            </li>
                            <li class="dropdown <?php echo $thisController == 'projects' ? "current open" : ""; ?>">
                                <a href="" data-toggle="dropdown" class="<?php echo $thisController == 'projects' ? "current" : ""; ?>">
                                    <span aria-hidden="true" class="se7en-feed"></span>Projects
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="<?php echo $thisController == 'projects' && $thisAction == "index" ? "current" : ""; ?>" href="<?= $this->Url->build([ "controller" => "projects", "action" => "index"]); ?>">View all Projects</a>
                                    </li>
                                    <li>
                                        <a class="<?php echo $thisController == 'projects' && $thisAction == "add" ? "current" : ""; ?>" href="<?= $this->Url->build([ "controller" => "projects", "action" => "add"]); ?>">Create Project</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php echo $thisController == 'tasks' ? "current open" : ""; ?>"><a data-toggle="dropdown" href="#">
                                    <span aria-hidden="true" class="se7en-star"></span>Tasks<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="<?php echo $thisController == 'tasks' && $thisAction == "index" ? "current" : ""; ?>" href="<?= $this->Url->build([ "controller" => "tasks", "action" => "index"]); ?>">View all Tasks</a>

                                    </li>
                                    <li>
                                        <a class="<?php echo $thisController == 'tasks' && $thisAction == "add" ? "current" : ""; ?>" href="<?= $this->Url->build([ "controller" => "tasks", "action" => "add"]); ?>">Create Task</a>

                                    </li>

                                </ul>
                            </li>
                            <li><a href="gallery.html">
                                    <span aria-hidden="true" class="se7en-gallery"></span>Attachments</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Navigation -->
            <div class="container-fluid main-content">
                <div class="page-title">
                    <h1>
                        <?= $this->fetch('title') ?>
                    </h1>
                </div>
                <div class="row">
                    <!-- Basic Table -->
                    <div class="col-lg-12">
                        <div class="widget-container fluid-height clearfix">
                            <div class="heading">
                                <i class="fa fa-table"></i><?= $this->get('_sub_title'); ?>
                            </div>
                            <div class="widget-content padded clearfix">
                                <?= $this->Flash->render() ?>
                                <?= $this->Flash->render('auth') ?>
                                <div class="row">
                                    <h1>Dashboard</h1>
                                    <?= $this->fetch('content') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Basic Table -->
                </div>
            </div>
        </div>
    </body>
</html>
