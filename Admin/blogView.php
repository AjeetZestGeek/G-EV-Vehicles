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
			<?php 
			$image = 'uploads/'.explode('_', $data['image'])[1];
			?>
			<img src="<?=$image;?>" class="w-100">
			<button class="btn btn-danger main-heading" id="alex-image-delete" onclick="confirm('Are you sure to delete?')">Delete</button>
			<div class="content-box large-con">
				<h6>Created At:<span><?=$data['blog_created_date'];?></span></h6>
				<h6>Created By:<span>Admin</span></h6>
			</div>
		</div>
		<div class="large-con mt-3">
		 <h5>Title: <span><?=$data['blog_title'];?>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#alex-image-delete').click(function(){
 			var thumb = '<?=$data['image'];?>';
   		var image = '<?=$image;?>';
   		$.post("ajax/remove_image.php",
	    {
        'thumb':thumb,
        'image':image
	    },function(data,status){
        if(status='success'){
          console.log('Image Removed');
          window.location.href = "blogView.php?id="+"<?=$_GET['id']?>"+"&title="+"<?=$_GET['title']?>";
        }else{
        	console.log('Issue');
        }
	    });
 		});
	});
</script>