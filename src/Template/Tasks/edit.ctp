<div class="col-md-12">
    <form enctype="multipart/form-data" action="<?= $this->Url->build([ "controller" => "tasks", "action" => "edit", $_id]); ?>" id="validateform" method="post" class="form-horizontal" >
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="name">Name</label>
                        <div class="col-md-7">
                            <input class="form-control" id="name" name="name" type="text" value='<?= $task->name ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="project_id">Project</label>
                        <div class="col-md-7">
                            <select name="project_id" id="project_id" class="select2able">
                                <option value="">Select Project</option>
                                <?php
                                foreach ($_all_projects as $project):
                                    ?>
                                    <option <?php echo $project->id == $task->project_id ? "selected" : ""; ?> value="<?= $project->id; ?>"><?= $project->name; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="to_user">Assignee</label>
                        <div class="col-md-7">

                            <select name="to_user" id="to_user" class="select2able">
                                <option value="">Select User</option>
                                <?php
                                foreach ($_all_users as $user):
                                    ?>
                                    <option <?php echo $user->id == $task->to_user ? "selected" : ""; ?> value="<?= $user->id; ?>"><?= $user->firstname . " " . $user->lastname; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="to_user">CC</label>
                        <div class="col-md-7">
                            <select name="cc_user" id="cc_user" class="select2able">
                                <option value="">Select User</option>
                                <?php
                                foreach ($_all_users as $user):
                                    ?>
                                    <option <?php echo $user->id == $task->cc_user ? "selected" : ""; ?> value="<?= $user->id; ?>"><?= $user->firstname . " " . $user->lastname; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="subject">Subject</label>
                        <div class="col-md-7">
                            <textarea class="summernote" name="subject" rows="18" id="subject"><?= $task->subject ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="allow_attachment">Attach</label>
                        <div class="col-md-7">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-default btn-file">
                                    <span class="fileupload-new">Add file</span>
                                    <span class="fileupload-exists">Add more</span>
                                    <input type="file" name="attach" id="attach" multiple>
                                </span>
                            </div>
                            <div id="container-image-uploaded">
                                <?php
                                if (count($_all_attach_file) > 0) {
                                    foreach ($_all_attach_file as $attach_file) {
                                        
                                        $attachment = $attach_file['a'];
                                    
                                        $fileType = 'doc';
                                        if (strpos($attachment['attach_type'], "image") > -1)
                                            $fileType = 'img';
                                        ?>
                                        <div class="col-sm-4">
                                            <div class="fileupload-container">
                                                <input type="hidden" value="<?= $attachment['id'] ?>" name="attach_id[]"> 
                                                <a target="_blank" href="<?= $this->request->webroot . 'webroot/' . $attachment['url'] ?>"> 
                                                    <?php
                                                    if ($fileType == 'img') {
                                                        ?>
                                                        <img src="<?= $this->request->webroot . 'webroot/' . $attachment['url'] ?>" >
                                                        <?php
                                                    } else {
                                                        ?><span class="file-attach  <?= $fileType ?>"></span>    <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="attach-info">
                                                <span class="attach-name"><?= $attachment['name'] ?></span>
                                                <input type="hidden" value="<?= $attachment['id'] ?>" id="attachment_id" />                                                
                                                <span class="attach-delete" title="remove" onclick="remove_attach(this)" ></span>
                                                <input type="hidden" value="<?= $attach_file['id'] ?>" id="fileattach_id" />
                                            </div></div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="notification_type">Notification type</label>
                        <?php global $task_status, $task_notification_rule; ?>
                        <div class="col-md-7">
                            <select name="notification_type" id="notification_type" class="form-control">
                                <?php
                                foreach ($task_notification_rule as $key => $val):
                                    ?>
                                    <option <?php echo $task->notification_type == $key ? "selected" : ""; ?> value="<?= $key ?>"><?= $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    $notification_value = explode(",", $task->notification_value);
                    ?>
                    <div class="form-group" id="weekly">
                        <label class="control-label col-md-2" for="notification_value">Select multi day</label>
                        <div class="col-md-7">
                            <label class="checkbox-inline"><input <?php echo in_array('Monday', $notification_value) ? "checked" : ""; ?> name="notification_value_weekly[]" type="checkbox" value="Monday" ><span>Monday</span></label>
                            <label class="checkbox-inline"><input <?php echo in_array('Tuesday', $notification_value) ? "checked" : ""; ?> name="notification_value_weekly[]" type="checkbox" value="Tuesday" ><span>Tuesday</span></label>
                            <label class="checkbox-inline"><input <?php echo in_array('Wednesday', $notification_value) ? "checked" : ""; ?> name="notification_value_weekly[]" type="checkbox" value="Wednesday"  ><span>Wednesday</span></label>
                            <label class="checkbox-inline"><input <?php echo in_array('Thursday', $notification_value) ? "checked" : ""; ?> name="notification_value_weekly[]" type="checkbox" value="Thursday"  ><span>Thursday</span></label>
                            <label class="checkbox-inline"><input <?php echo in_array('Friday', $notification_value) ? "checked" : ""; ?> name="notification_value_weekly[]" type="checkbox" value="Friday"  ><span>Friday</span></label>
                            <label class="checkbox-inline"><input <?php echo in_array('Saturday', $notification_value) ? "checked" : ""; ?> name="notification_value_weekly[]" type="checkbox" value="Saturday"  ><span>Saturday</span></label>
                            <label class="checkbox-inline"><input <?php echo in_array('Sunday', $notification_value) ? "checked" : ""; ?> name="notification_value_weekly[]" type="checkbox" value="Sunday"  ><span>Sunday</span></label>
                        </div>
                    </div>
                    <div class="form-group" id="monthly">
                        <label class="control-label col-md-2" for="notification_value">Select mutil day</label>
                        <div class="col-md-7">
                            <select class="select2able" multiple id="notic_rule_monthly" name="notification_value_monthly">
                                <?php
                                for ($i = 1; $i < 32; $i++) {
                                    ?>
                                    <option <?php echo in_array($i, $notification_value) && $task->notification_type == 'monthly' ? "selected" : "" ?> value="<?= $i ?>"><?= $i ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="hidden" name="_notification_value_monthly" id="_notification_value_monthly" value='<?= $task->notification_value ?>'/>

                        </div>
                    </div>
                    <div class="form-group" id="dates">
                        <label class="control-label col-md-2" for="notification_value">Select multi date</label>
                        <div class="col-md-7">
                            <div class="input-group date "  >
                                <input class="form-control datepicker" value='<?php echo $task->notification_type == 'dates' ? $task->notification_value : ""; ?>' data-date-format="dd-mm-yyyy" type="text" name="_notification_value_date" id="_notification_value_date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i></span></input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="times">
                        <label class="control-label col-md-2" for="notification_value">Notification time</label>
                        <div class="col-md-7">
                            <div class="input-group bootstrap-timepicker">
                                <input value='<?php echo date("h:i A", strtotime($task->notification_time)); ?>' class="form-control" id="timepicker-default" name="notification_time" type="text">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="status">Status</label>
                        <div class="col-md-7">
                            <select name="status" id="status" class="form-control" >
                                <?php
                                foreach ($task_status as $key => $val):
                                    ?>
                                    <option <?php echo $task->status == $key ? "selected" : ""; ?> value="<?= $key ?>"><?= $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" ></label>
                        <div class="col-md-7">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </div>
                </div>   
            </div>

        </fieldset>
    </form>	
</div>
<script type="text/javascript">
    $("#attach").change(function () {
        var i = 0, len = this.files.length, img, reader, file;
        //Create image cards
        for (; i < len; i++) {
            var card_image = '<div class="col-sm-4" id="card-img-' + i + '"><div class="fileupload-container">';
            card_image += '<p class="loading"><i></i><span><?php echo __('Uploading...'); ?></span></p>';
            card_image += '</div></div>';
            jQuery("#container-image-uploaded").prepend(card_image);
        }
        var j = 0;

        for (; j < len; ++j) {
            file = this.files[j];
            formdata = new FormData();
            formdata.append("images[]", file);
            formdata.append("item", j);
            jQuery.ajax({
                url: "<?= $this->Url->build([ "controller" => "attachments", "action" => "upload"]); ?>",
                type: "POST",
                data: formdata,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    var data = JSON.parse(res);
                    var myid = "#card-img-" + data.item;
                    jQuery(myid).html(data.content);
                    jQuery(myid).removeAttr("id");
                }
            });

        }
    })
    $(document).ready(function () {
        $("#monthly, #dates, #weekly ").hide();
        $('#<?= $task->notification_type ?>').show();
        $("#notification_type").change(function () {
            var notic_type = $(this).val();
            if (notic_type == 'monthly') {
                $("#weekly, #dates").hide();
                $("#monthly").show();
            } else if (notic_type == 'weekly') {
                $("#monthly, #dates").hide();
                $("#weekly").show();
            } else if (notic_type == 'dates') {
                $("#monthly, #weekly").hide();
                $("#dates").show();
            } else {
                $("#monthly, #dates, #weekly ").hide();
            }
        });
        $("#notic_rule_monthly").change(function () {
            var _arr = $(this).val();

            $("#_notification_value_monthly").val(_arr.join());
        });
        $("#validateform").submit(function () {
            $("#subject").html($("div.note-editable").html());
            return true;
        });
        
    })
    function remove_attach(me){
        var x = confirm("Are you sure want to remove this?");
        if(x){
            var attach_id = $(me).prev("input[type='hidden']").val();
            var fileattach_id = $(me).next("input[type='hidden']").val();
            formdata = new FormData();
            formdata.append("attach_id", attach_id);
            formdata.append("fileattach_id", fileattach_id);
            $.ajax({
                url: "<?= $this->Url->build( ["controller"=> "tasks", "action"=>"removeattach"] ) ?>",
                method: "POST",
                data: formdata,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    $(me).closest('div.col-sm-4').remove();
                }
            });
        }
    }
    $("#validateform").validate({
        rules: {
            name: "required",
            project_id: "required",
            to_user: "required",
            notification_type: "required"
        },
        messages: {
            name: "Please enter Tasks name",
            project_id: "Please select Project",
            to_user: "Please select User",
            notification_type: "Please select Notification type"
        }
    });
</script>