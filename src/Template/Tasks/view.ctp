<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php if ($userData['id'] == $task->user->id): ?>
                    <button class="btn btn-default" data-toggle="modal" href="#editTask">Edit</button>
                <?php endif ?>
                <?php
                if ($task->status == 'open'):
                    echo '<button class="btn btn-default">Assgin</button>';
                endif;
                ?>
                <button class="btn btn-default showcomment">Comment</button>
                <?php
                if ($task->status == 'inprogress'):
                    echo '<button class="btn btn-default">Resolved</button>';
                endif;
                ?>
                <?php
                if ($userData['id'] == $task->user->id):
                    echo '<button class="btn btn-default">Closed</button>';
                endif;
                ?>             
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="module toggle-wrap">
                <div class="mod-header">
                    <h2 class="toggle-title">Details</h2>
                </div>
                <div class="mod-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="field_val">
                                <span class="name"> Status: </span>
                                <span class="value"><?= $this->Libu->buildStatus($task->status) ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="field_val">
                                <span class="name">Nofification type: </span>
                                <span class="value"><?= $task->notification_type ?></span>
                            </div>
                            <div class="field_val">
                                <span class="name">Nofification value: </span>
                                <?php $notification_value = explode(",", $task->notification_value); ?>
                                <span class="value"><?= $task->notification_value ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="module toggle-wrap">
                <div class="mod-header">
                    <h2 class="toggle-title">Description</h2>
                </div>
                <div class="mod-content">
                    <?= $task->subject ?>
                </div>
            </div>
            <div class="module toggle-wrap">
                <div class="mod-header">
                    <h2 class="toggle-title">Attachments</h2>
                </div>
                <div class="mod-content">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn btn-default btn-file">
                            <span class="fileupload-new">Add file</span>
                            <span class="fileupload-exists">Add more</span>
                            <input type="file" name="attach" id="attach" multiple>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="container-image-uploaded">
                            <?php
                            if (count($_all_attach_file) > 0) {
                                foreach ($_all_attach_file as $attach_file) {

                                    $attachment = $attach_file['a'];

                                    $fileType = 'doc';
                                    if (strpos($attachment['attach_type'], "image") > -1)
                                        $fileType = 'img';
                                    ?>
                                    <div class="col-sm-3">
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
            </div>
            <div class="module toggle-wrap">
                <div class="mod-header">
                    <h2 class="toggle-title">Activity</h2>
                </div>
                <div class="mod-content">
                    <div class="heading tabs">

                        <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>Comments</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab2"><i class="fa"></i><span>History</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content padded" id="my-tab-content">
                        <div class="tab-pane active" id="tab1">
                            <?php
                            $i = 0;
                            foreach ($comments as $item) {
                                $user = $item['u'];
                                ?>
                                <blockquote class="comment-item">
                                    <p><?= $item['name'] ?></p>
                                    <small>@<?= $user['name'] ?> - <?= $this->Libu->timeAgo($item['created_date']); ?></small>
                                    <div class="actions">
                                        <a  class="table-actions fa fa-pencil" data-toggle="modal" href="#myModal<?= $i ?>"></a>
                                        <a class="table-actions fa fa-trash-o" onclick="deleteComment(this, <?= $item['id'] ?>)"></a>
                                    </div>
                                </blockquote>
                                <div class="modal fade" id="myModal<?= $i ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                                                <h4 class="modal-title">
                                                    Edit comment
                                                </h4>
                                            </div>
                                            <form action="<?= $this->Url->build([ "controller" => "tasks", "action" => "view", $_id]); ?>" class="edit-comment haseditor" method="post" class="form-horizontal" >
                                                <div class="modal-body">
                                                    <input type="hidden" name="action" value="edit_comment">
                                                    <input type="hidden" name="comment_id" value="<?= $item['id'] ?>">
                                                    <fieldset>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-2" for="name">Created</label>
                                                                    <label style="text-align:left;" class="control-label col-md-10" for="name"><?php
                                                                        $date = new DateTime($item['created_date']);
                                                                        echo $date->format('d/m/Y');
                                                                        ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-2" for="subject">Comment</label>
                                                                    <div class="col-md-10"><textarea class="summernote" name="comments" rows="18" id="comments"><?= $item['name'] ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>   
                                                        </div>

                                                    </fieldset>

                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                                    <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i = $i + 1;
                            }
                            ?>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h3>
                                History
                            </h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque imperdiet auctor purus, non imperdiet sapien dapibus non. Phasellus pretium rutrum elit in cursus. Donec ullamcorper nec massa vel mattis. Curabitur eros metus, dapibus quis est et, dapibus imperdiet dolor.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="module toggle-wrap" style="clear: both;">
                <div class="col-md-12">
                    <form class="haseditor frmcomment" style="display:none" id="validateform" action="<?= $this->Url->build(["controller" => "tasks", "action" => "view", $_id]) ?>" method="post">
                        <input type="hidden" name="task_id" value="<?= $_id ?>" />
                        <label class="control-label " for="subject">Comment</label>
                        <textarea class="summernote" name="comments" rows="5" id="comments"></textarea>
                        <button class="btn btn-default" style="margin-top:20px;">Add</button>
                        <a id="cancelcomment" href="">Cancel</a>
                    </form>
                    <button class="btn btn-info showcomment bottom" style="margin-top:20px;" ><i class="fa fa-comment"></i>Comment</button>
                </div>
            </div>
        </div>   
        <div class="col-md-4">
            <div class="module toggle-wrap">
                <div class="mod-header">
                    <h2 class="toggle-title">People</h2>
                </div>
                <div class="mod-content">
                    <div class="field_val">
                        <span class="name">Assignee:</span>
                        <span class="value"><?= count($to_user) > 0 ? $to_user[0]->name : "No assign" ?></span>
                    </div>
                    <div class="field_val">
                        <span class="name">Reporter: </span>
                        <span class="value"><?= $task->user->name ?></span>
                    </div>
                </div>
            </div>
            <div class="module toggle-wrap">
                <div class="mod-header">
                    <h2 class="toggle-title">Dates</h2>
                </div>
                <div class="mod-content">
                    <div class="field_val">
                        <span class="name">Created: </span>
                        <span class="value"><?php
                            $date = new DateTime($task->created_date);
                            echo $date->format('d/mY');
                            ?></span>
                    </div>
                    <div class="field_val">
                        <span class="name">Updated: </span>
                        <span class="value"><?php
                            $date = new DateTime($task->modified_date);
                            echo $date->format('d/mY');
                            ?></span>
                    </div>
                </div>
            </div>
            <div class="module toggle-wrap">
                <div class="mod-header">
                    <h2 class="toggle-title">Tasks related</h2>
                </div>
                <div class="mod-content">
                    <ul class="list-custom">
                        <?php
                        if (count($tasksRelate) > 0) {
                            foreach ($tasksRelate as $task) {
                                echo "<li><a href='" . $this->Url->build(["controller" => "tasks", "action" => "view", $task->id]) . "'>" . $task->name . "</a></li>";
                            }
                        } else {
                            echo "<li>NO TASK RELATED</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>  
    </div>
</div>
<div class="modal fade" id="editTask">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Edit task
                </h4>
            </div>
            <form  action="<?= $this->Url->build([ "controller" => "tasks", "action" => "view", $_id]); ?>" id="validateform" method="post" class="form-horizontal haseditor" >
                <input type="hidden" name="action" value="edit_task"/>
                <div class="modal-body">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="name">Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="name" name="name" type="text" value='<?= $task->name ?>'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="project_id">Project</label>
                                    <div class="col-md-10">
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
                                    <div class="col-md-10">

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
                                    <div class="col-md-10">
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
                                    <label class="control-label col-md-2" for="subject">Description</label>
                                    <div class="col-md-10">
                                        <textarea class="summernote" name="subject" rows="18" id="subject"><?= $task->subject ?></textarea>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Submit">
                    <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#attach").change(function () {
        var i = 0, len = this.files.length, img, reader, file;
        //Create image cards
        for (; i < len; i++) {
            var card_image = '<div class="col-sm-3" id="card-img-' + i + '"><div class="fileupload-container">';
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
            formdata.append("task_id", <?= $task->id ?>);
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
        $(".showcomment").click(function () {
            $("form.frmcomment").show();
            $("form.frmcomment .note-editable").focus();
            $('html, body').animate({
                scrollTop: $("form.frmcomment .note-editable").offset().top
            }, 1);
            $('.showcomment.bottom').hide();
            return false;
        });
        $("#cancelcomment").click(function () {
            $("form.frmcomment").hide();
            $(".showcomment.bottom").show();
            return false;
        })
        $("form.haseditor").submit(function () {
            $(this).find("textarea").html($(this).find("div.note-editable").html());

        });

    });
    function deleteComment(me, id) {
        var x = confirm("Are you sure want to delete this?");
        if (x) {
           
            formdata = new FormData();
            formdata.append("comment_id", id);
            formdata.append("task_id", <?= $task->id ?>);
            $.ajax({
                url: "<?= $this->Url->build(["controller" => "tasks", "action" => "deletecomment"]) ?>",
                method: "POST",
                data: formdata,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                   $(me).closest('blockquote').remove();
                }
            });
        }
    }
    function remove_attach(me) {
        var x = confirm("Are you sure want to remove this?");
        if (x) {
            var attach_id = $(me).prev("input[type='hidden']").val();
            var fileattach_id = $(me).next("input[type='hidden']").val();
            formdata = new FormData();
            formdata.append("attach_id", attach_id);
            formdata.append("fileattach_id", fileattach_id);
            $.ajax({
                url: "<?= $this->Url->build(["controller" => "tasks", "action" => "removeattach"]) ?>",
                method: "POST",
                data: formdata,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    $(me).closest('div.col-sm-3').remove();
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