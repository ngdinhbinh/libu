<form method="post" action="<?= $this->Url->build(["controller" => "users", "action" => "register"]); ?>" id="validate-form">
    
    <div class="form-group">
        <input class="form-control" placeholder="First name" type="text" name="firstname"/>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Last name" type="text" name="lastname">
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Enter your email address" type="text" name="email">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" placeholder="Enter your password" name="password" id="password">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" placeholder="Enter your password" name="repassword" id="repassword">
    </div>
    <div class="form-group">
        <label class="checkbox text-left"><input type="checkbox"><span>I agree to the terms and conditions.</span></label>
    </div>
    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign up">
    <div class="social-login clearfix">
        <a class="btn btn-primary pull-left facebook" href="<?= $this->Url->build([ "controller" => "users", "action" => "social_login"] ); ?>/Facebook"><i class="fa fa-facebook"></i>Sign up with facebook</a>
        <a class="btn btn-primary pull-right google" href="<?= $this->Url->build([ "controller" => "users", "action" => "social_login"] ); ?>/Google"><i class="fa fa-google"></i>Sign up with G+</a>
    </div>
    <p>
        Already have an account?
    </p>
    <a class="btn btn-default-outline btn-block" href="<?= $this->Url->build(["controller" => "users", "action" => "login"]); ?>">Login now</a>
</form>
<script type="text/javascript">
$("#validate-form").validate({
      rules: {
        firstname: "required",
        lastname: "required",
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 6
        },
        repassword: {
          required: true,
          minlength: 6,
          equalTo: "#password"
        }
      },
      messages: {
        firstname: "Please enter First name.",
        lastname: "Please enter Last name.",
        email: "Please enter a valid email address.",
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long"
        },
        repassword: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long",
          equalTo: "Please enter the same password"
        }
    }
    });
</script>