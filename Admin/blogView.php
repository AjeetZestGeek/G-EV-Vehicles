<?php 
  require_once('header.php');
  require_once('db/category-process.php');
  require_once('db/blog-process.php');
  $sc = new blog();
  $sc->setId($_GET['id']);
  $data = $sc->fetchOne()[0];
?>

<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="class-main justify-content-center">
		<div class="card-main-box d-flex">
			<img src="https://gadgetsalerts.wiki/assets/images/apple_watch.jfif" class="w-100">
			<div class="content-box large-con">
				<h6>Created At:<span><?=$data['created_date'];?></span></h6>
				<h6>Created By:<span>Admin</span></h6>
			</div>
		</div>
		<div class="large-con mt-3">
		 <h5>Title: <span><?=$data['title'];?>
</span></h5>
		 <h5>Content:
		 	<span><?=$data['content'];?></span>
		 </h5>

		 </div>
		</div>
	</div>
</div>
<?php 
  require_once('footer.php');
?>