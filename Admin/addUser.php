<?php 
  require_once('header.php');
  require_once('db/addUserProcess.php');
?>
  
<div class="container">
  <h2><?php if(isset($_GET['id'])){ echo 'Update User';}else{echo 'Add User';}?></h2>
  <form class="form-horizontal" action="" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="username">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="username" placeholder="Enter user name" name="username" value="<?=isset($data['username'])?$data['username']:'';?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="phone">Phone:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone" value="<?=isset($data['phone'])?$data['phone']:'';?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?=isset($data['email'])?$data['email']:'';?>">
      </div>
    </div>
    <?php if(!isset($_GET['id'])){ ?>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="conpwd">Confirm Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="conpwd" placeholder="Enter confirm password" name="conpwd">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
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