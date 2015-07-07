			<div class="col-md-12">
			<form action="<?= $this->Url->build([ "controller" => "projects",  "action" => "edit"]); ?>" id="validate-form" method="post" >
				<input type="hidden" name="_method" value="PUT">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Project Name</label><input class="form-control" id="name"
                                                                                    name="name" type="text" value="<?= $project->name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="project_key">Project Key</label><input class="form-control" id="project_key"
                                                                                 name="project_key" type="text" value="<?= $project->project_key ?>">
                                </div>
                            </div>
                           
                        </div>
                        <input class="btn btn-primary" type="submit" value="Submit">
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
        name: "Please enter Project name",
        project_key: "Please enter Project Key"
	  }
    });

</script>