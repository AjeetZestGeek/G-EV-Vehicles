<?php 
  require_once('header.php');
  require_once('db/addUserProcess.php');
?>
  
<div class="container">
  <form class="form-horizontal" action="" method="post">
    <h2 class="mb-3"><?php if(isset($_GET['id'])){ echo 'Update User';}else{echo 'Add User';}?></h2>
    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="username">Name: <span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="username" placeholder="Enter user name" name="username" value="<?=isset($data['username'])?$data['username']:'';?>">
        <span class="error-msg"><?=(isset($sc)&&($sc->getUsername()=='')?'Please fill username':'');?></span>
      </div>
    </div>
    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="phone">Phone: <span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone" value="<?=isset($data['phone'])?$data['phone']:'';?>">
        <span class="error-msg"><?=(isset($sc)&&$sc->getPhone()==''?'Please fill phone':'');?></span>
      </div>
    </div>
    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="email">Email: <span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?=isset($data['email'])?$data['email']:'';?>">
        <span class="error-msg"><?=isset($sc)&&$sc->getEmail()==''?'Please fill email':'';?></span>
      </div>
    </div>
    <?php if(!isset($_GET['id'])){ ?>
    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="pwd">Password: <span class="text-danger">*</span></label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        <span class="error-msg"><?=isset($sc)&&$sc->getPassword()==''?'Please fill password':'';?></span>
      </div>
    </div>
    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="conpwd">Confirm Password: <span class="text-danger">*</span></label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="conpwd" placeholder="Enter confirm password" name="conpwd">
        <span class="error-msg"><?=isset($msg)?$msg:'';?></span>
      </div>
    </div>
  <?php } ?>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="<?=$class;?>" name="submit" value="<?=$type;?>"><?php if(!isset($_GET['id'])){ echo 'Submit';}else{echo 'Update';}?></button>
        <a href="userlist.php"><button type="button" class="btn btn-danger" onclick="confirm('Are want to cancel ?')">Cancel</button></a>
      </div>
    </div>
  </form>
</div>

<?php 
  require_once('footer.php');
?>