<!DOCTYPE html>
<html>
  <head>
    <?php $cakeDescription = ' LIBU'; ?>
        <title>
             <?= $this->fetch('title') ?> - 
            <?= $cakeDescription ?>
        </title>
        <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
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
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="login2">
    <!-- Login Screen -->
    <div class="login-wrapper">
        <a href="./"><?= $this->Html->image('libu-logo.png') ?></a>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <p>
            Don't have an account yet?
        </p>
      <a class="btn btn-default-outline btn-block" href="<?= $this->Url->build( [ "controller" => "users", "action" => "register"] ); ?>">Sign up now</a>
    </div>
    <!-- End Login Screen -->
  </body>
</html>