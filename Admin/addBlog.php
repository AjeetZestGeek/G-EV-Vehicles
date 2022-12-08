<?php 
  require_once('header.php');
  require_once('db/category-process.php');
  require_once('db/blog-process.php');
  $cat = new category();
  $record = $cat->fetchAll();
?>
  
<div class="container">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
      <h2 class="mb-3"><?php if(isset($_GET['id'])){ echo 'Update';}else{echo 'Add';}?> Blog</h2>
    <input type="hidden" name="user_id" value="<?=$userdata['id']?>">
    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="category_id">Category: <span class="text-danger">*</span></label>
      <div class="col-sm-10">
      	<select class="form-control" name="category_id" aria-label="select">
          <?php 
          foreach ($record as $key => $value) { 
          ?>
          <option value="<?=$value['id'];?>" <?=isset($data['category_id'])&&$data['category_id']==$value['id']?'selected':'';?>><?=$value['title'];?></option>
        <?php } ?>
        </select>
        <span class="error-msg"><?=(isset($sc)&&($sc->getCategoryId()=='')?'Please select category':'');?></span>
      </div>
    </div>

    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="title">Title: <span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="<?=isset($data['title'])?$data['title']:'';?>">
        <span class="error-msg"><?=(isset($sc)&&($sc->getTitle()=='')?'Please fill title':'');?></span>
      </div>
    </div>

    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="content">Content: <span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <textarea class="form-control form-control-lg" id="content" name="content"><?=isset($data['content'])?$data['content']:'';?></textarea>
        <span class="error-msg"><?=(isset($sc)&&($sc->getContent()=='')?'Please fill content':'');?></span>
      </div>
    </div>

    <div class="form-group d-flex align-items-center">
      <label class="control-label col-sm-2" for="image">Image: <span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="file" class="form-control-file" id="image" placeholder="Enter image name" name="image">
        <input type="hidden" name="old-image" value="<?=isset($data['image'])?$data['image']:'';?>">
        <span class="error-msg"><?=(isset($sc)&&($sc->getImage()=='')?'Please choose image':'');?></span>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="<?=$class;?>" name="blog-submit" value="<?=$type;?>"><?php if(!isset($_GET['id'])){ echo 'Add';}else{echo 'Update';}?></button>
        <a href="categorylist.php"><button type="button" class="btn btn-danger" onclick="confirm('Are want to cancel ?')">Cancel</button></a>
      </div>
    </div>
  </form>
</div>

<?php 
  require_once('footer.php');
?>