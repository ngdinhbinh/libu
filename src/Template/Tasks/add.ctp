
<div class="col-md-12">
   
    <form action="<?= $this->Url->build([ "controller" => "tasks",  "action" => "add"]); ?>" id="validate-form" method="post" class="form-horizontal" >
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
                                    foreach($_all_projects as $project):
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
                                    foreach($_all_users as $user):
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
                                    foreach($_all_users as $user):
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
                             <div class="summernote" id="subject" ></div>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="allow_attachment"></label>
                         <div class="col-md-7">
                             <label class="checkbox"><input type="checkbox" name="allow_attachment" id="allow_attachment"><span>Allow attachment</span></label>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="notification_type">Notification type</label>
                         <?php global $task_status, $task_notification_rule; ?>
                         <div class="col-md-7">
                            <select name="notification_type" id="notification_type" class="form-control">
                             <?php 
                                    foreach($task_notification_rule as $key=>$val): 
                                ?>
                                    <option value="<?= $key ?>"><?= $val ?></option>
                                <?php
                                    endforeach; 
                                   ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group" id="weekly">
                        <label class="control-label col-md-2" for="notification_value">Notification value</label>
                        <div class="col-md-7">
                            <label class="checkbox-inline"><input type="checkbox"><span>Monday</span></label>
                            <label class="checkbox-inline"><input type="checkbox"><span>Tuesday</span></label>
                            <label class="checkbox-inline"><input type="checkbox"><span>Wednesday</span></label>
                            <label class="checkbox-inline"><input type="checkbox"><span>Thursday</span></label>
                            <label class="checkbox-inline"><input type="checkbox"><span>Friday</span></label>
                            <label class="checkbox-inline"><input type="checkbox"><span>Saturday</span></label>
                            <label class="checkbox-inline"><input type="checkbox"><span>Sunday</span></label>
                        </div>
                    </div>
                    <div class="form-group" id="monthly">
                        <label class="control-label col-md-2" for="notification_value">Notification value</label>
                        <div class="col-md-7">
                            <select class="select2able" multiple="" id="notic_rule_monthly" name="notic_rule_monthly">
                                <?php 
                                    for($i=1;$i<32;$i++){
                                        ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                <?php
                                    }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="dates">
                        <label class="control-label col-md-2" for="notification_value">Notification value</label>
                        <div class="col-md-7">
                            <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                <input class="form-control" type="text" name="notic_rule_dates" id="notic_rule_dates"><span class="input-group-addon"><i
                                    class="fa fa-calendar"></i></span></input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="dates">
                        <label class="control-label col-md-2" for="notification_value">Notification time</label>
                        <div class="col-md-7">
                            <div class="input-group bootstrap-timepicker">
                                <input class="form-control" id="timepicker-default" type="text"><span
                                    class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="status">Status</label>
                         <div class="col-md-7">
                            <select name="status" id="status" class="form-control" >
                                <?php 
                                    foreach($task_status as $key=>$val): 
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
$("#validate-form").validate({
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