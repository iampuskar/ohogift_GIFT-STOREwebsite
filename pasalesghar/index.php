<?php
$page_title="Login Page";
require 'inc/top-link.php';
require_once CLASS_PATH.'/baseModel.php';
require_once CLASS_PATH.'/user.php';

$user = new User();
if(isset($_SESSION,$_SESSION['session_id']) && !empty($_SESSION['session_id'])){
  $session_id= $_SESSION['session_id'];
  $user_by_session_id = $user->getUserByhash($session_id);
  if(!$user_by_session_id){
    redirect('logout');
  }elseif ($user_by_session_id) {
    redirect('dashboard','success','You are already logged in.');
  }


}

if(isset($_COOKIE['_au_us_ad']) && !empty($_COOKIE['_au_us_ad'])){
  $cookie_token= $_COOKIE['_au_us_ad'];
  $user_info = $user->getUserByhash($cookie_token);
   

  

  if(!$user_info){
    redirect('logout');

  }else{
    $token= randomString();
    $user_update['hash']=$token;
     $user_update['last_login'] = date('Y-m-d h:i:s A');



     $user->user_id =$user_info[0]->id;
     if($user->updateUser($user_update))  {
      $_SESSION['session_id'] = $token;
      $_SESSION['full_name'];
      setcookie('_au_us_ad', $token, (time()+864000), '/pasalesghar');
     // debugger($user_update, true);
      redirect('./dashboard','succcess','You have been redirected from Cookie');
     }

  }
}
?>
     <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

            <?php flash();?>
            <form method="post" action="process/login">
              <h1>Admin Login Form</h1>
              <div>
                <input type="email" class="form-control" placeholder="Username" required="" name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
                <?php if(isset($_SESSION['password_error'])&& !empty($_SESSION['password_error'])){
                   ?>
                   <p class="alert alert-danger">Password does not match</p>
                   <?php
                   unset($_SESSION['password_error']);
                }    ?>

                <br>
                <input type="checkbox" name="remember_me" value="1">Remember Me
              </div>
              <div>
                <button class="btn btn-default submit">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-home"></i>Pasale's Home</h1>
                  <p>&copy; <?php echo date("Y");?>  All Right Reserved To Pasale's Home</p>
                  <a href="../index" class="btn btn-success " >Home</a>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
  