<?php 
  require_once('header.php');
  require_once('db/category-process.php');
?>
  
<div class="container">
  <form class="form-horizontal" action="" method="post">
    <h2 class="mb-3"><?php if(isset($_GET['id'])){ echo 'Update';}else{echo 'Add';}?> Category</h2>
    <input type="hidden" name="user_id" value="<?=$userdata['id']?>">
    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="title">Title: <span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="title" placeholder="Enter title name" name="title" value="<?=isset($data['title'])?$data['title']:'';?>">
        <span class="error-msg"><?=(isset($sc)&&($sc->getTitle()=='')?'Please fill title':'');?></span>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="<?=$class;?>" name="submit" value="<?=$type;?>"><?php if(!isset($_GET['id'])){ echo 'Add';}else{echo 'Update';}?></button>
        <a href="blogCategory.php"><button type="button" class="btn btn-danger" onclick="confirm('Are want to cancel ?')">Cancel</button></a>
      </div>
    </div>
  </form>
</div>

<?php 
  require_once('footer.php');
?>