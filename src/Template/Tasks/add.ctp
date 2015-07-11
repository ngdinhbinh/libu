
<div class="col-md-12">

    <form enctype="multipart/form-data" action="<?= $this->Url->build([ "controller" => "tasks", "action" => "add"]); ?>" id="validateform" method="post" class="form-horizontal" >
        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="name">Name</label>
                        <div class="col-md-7">
                            <input class="form-control" id="name" name="name" type="text">
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
                                    <option value="<?= $project->id; ?>"><?= $project->name; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="to_user">To</label>
                        <div class="col-md-7">

                            <select name="to_user" id="to_user" class="select2able">
                                <option value="">Select User</option>
                                <?php
                                foreach ($_all_users as $user):
                                    ?>
                                    <option value="<?= $user->id; ?>"><?= $user->firstname . " " . $user->lastname; ?></option>
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
                                    <option value="<?= $user->id; ?>"><?= $user->firstname . " " . $user->lastname; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="subject">Subject</label>
                        <div class="col-md-7">
                            <textarea class="summernote" name="subject" rows="18" id="subject">
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="allow_attachment">Attach</label>
                        <div class="col-md-7">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-default btn-file">
                                    <span class="fileupload-new">Select file</span>
                                    <span class="fileupload-exists">Change</span>
                                    <input type="file" name="attach" id="attach" multiple>
                                </span>
                            </div>
                            <div id="container-image-uploaded">

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
                                    <option value="<?= $key ?>"><?= $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="weekly">
                        <label class="control-label col-md-2" for="notification_value">Select multi day</label>
                        <div class="col-md-7">
                            <label class="checkbox-inline"><input name="notification_value_weekly[]" type="checkbox" value="Monday" ><span>Monday</span></label>
                            <label class="checkbox-inline"><input name="notification_value_weekly[]" type="checkbox" value="Tuesday" ><span>Tuesday</span></label>
                            <label class="checkbox-inline"><input name="notification_value_weekly[]" type="checkbox" value="Wednesday"  ><span>Wednesday</span></label>
                            <label class="checkbox-inline"><input name="notification_value_weekly[]" type="checkbox" value="Thursday"  ><span>Thursday</span></label>
                            <label class="checkbox-inline"><input name="notification_value_weekly[]" type="checkbox" value="Friday"  ><span>Friday</span></label>
                            <label class="checkbox-inline"><input name="notification_value_weekly[]" type="checkbox" value="Saturday"  ><span>Saturday</span></label>
                            <label class="checkbox-inline"><input name="notification_value_weekly[]" type="checkbox" value="Sunday"  ><span>Sunday</span></label>
                        </div>
                    </div>
                    <div class="form-group" id="monthly">
                        <label class="control-label col-md-2" for="notification_value">Select mutil day</label>
                        <div class="col-md-7">
                            <select class="select2able" multiple id="notic_rule_monthly" name="notification_value_monthly">
                                <?php
                                for ($i = 1; $i < 32; $i++) {
                                    ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="hidden" name="_notification_value_monthly" id="_notification_value_monthly"/>

                        </div>
                    </div>
                    <div class="form-group" id="dates">
                        <label class="control-label col-md-2" for="notification_value">Select multi date</label>
                        <div class="col-md-7">
                            <div class="input-group date "  >
                                <input class="form-control datepicker"  data-date-format="dd-mm-yyyy" type="text" name="_notification_value_date" id="_notification_value_date"><span class="input-group-addon"><i
                                        class="fa fa-calendar"></i></span></input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="times">
                        <label class="control-label col-md-2" for="notification_value">Notification time</label>
                        <div class="col-md-7">
                            <div class="input-group bootstrap-timepicker">
                                <input class="form-control" id="timepicker-default" name="notification_time" type="text"><span
                                    class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
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
                                    <option value="<?= $key ?>"><?= $val ?></option>
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
            jQuery("#container-image-uploaded").append(card_image);
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
        })
    })
    $("#validateform").validate({
        rules: {
            name: "required",
            project_key: "required",
        },
        messages: {
            name: "Please enter Tasks name",
            lastname: "Please enter Project Key"
        }
    });
</script>