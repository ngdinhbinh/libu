
<form action="<?= $this->Url->build([ "controller" => "users", "action" => "login"]); ?>" method="post" >
    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
    <?= $this->Flash->render() ?>
    <?= $this->Flash->render('auth') ?>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input class="form-control" placeholder="Username or Email" type="text" name="email" id="email">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input class="form-control" placeholder="Password" type="password" name="password" type="password">
        </div>
    </div>
    <a class="pull-right" href="#">Forgot password?</a>
    <div class="text-left">
        <label class="checkbox"><input type="checkbox"><span>Keep me logged in</span></label>
    </div>
    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Log in">
    <div class="social-login clearfix">
        <a class="btn btn-primary pull-left facebook" href="index.html"><i class="fa fa-facebook"></i>Login with facebook</a>
        <a class="btn btn-primary pull-right twitter" href="index.html"><i class="fa fa-twitter"></i>Login with twitter</a>
    </div>
</form>