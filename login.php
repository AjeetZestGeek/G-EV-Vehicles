<?php 
include 'header.php';
include 'Admin/db/user-config.php';
if(isset($_POST['login'])){
    $obj = new userConfig();
    $obj->setUsername($_POST['username']);
    $obj->setPassword($_POST['password']);
    if($obj->login()){
        echo "<script>alert('Loged In Successfully');window.location = 'Admin/index.php';</script>";
    }else{
        if(isset($idVerified)&&!$idVerified){
            echo "<script>alert('Your Id is not vrified!!!');window.location = 'login.php';</script>";
        }else{
            echo "<script>alert('Username/Password wrong');window.location = 'login.php';</script>";
        }
    }
}
?>
<div class="col-12">
    <h2 class="tm-color-primary tm-post-title tm-mb-60">Login</h2>
</div>
<div class="col-lg-7 tm-contact-left">
    <form method="POST" action="" class="mb-5 ml-auto mr-0 tm-contact-form">                        
        <div class="form-group row mb-4">
            <label for="name" class="col-sm-3 col-form-label text-right tm-color-primary">Usrename</label>
            <div class="col-sm-9">
                <input class="form-control mr-0 ml-auto" name="username" id="username" type="text" required>                            
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="password" class="col-sm-3 col-form-label text-right tm-color-primary">Password</label>
            <div class="col-sm-9">
                <input class="form-control mr-0 ml-auto" name="password" id="password" type="password" required>
            </div>
        </div>
        <div class="form-group row text-right">
            <div class="col-12">
                <button class="tm-btn tm-btn-primary tm-btn-small" name="login" id="btn-admin-login">Login</button>
            </div>                            
        </div>                                
    </form>
</div>
<?php 
include 'footer.php';
?>