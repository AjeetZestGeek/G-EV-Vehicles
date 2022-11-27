<?php 
require_once('blog.php');
$type = 'save';
$class = 'btn btn-primary';
if (isset($_GET['id'])&&isset($_GET['req'])&&isset($_GET['page'])&&$_GET['page']=='blog') {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn btn-warning';
		$sc = new blog();
		$sc->setId($_GET['id']);
		$data = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new blog();
		$sc->setId($_GET['id']);
		$data = $sc->delete();
	}
	if($_GET['req']=='update-status'){
		$sc = new blog();
		$sc->setId($_GET['id']);
		$sc->setStatus($_GET['val']);
		$data = $sc->changeStatus();
	}
}
if (isset($_POST['blog-submit'])) {
	$sc = new blog();
	$sc->setTitle($_POST['title']);
	$sc->setCategoryId($_POST['category_id']);
	$sc->setContent($_POST['content']);
	if($_POST['blog-submit']=='save'){
		$sc->setCreatedBy($_POST['user_id']);
		if($_POST['title']!=''&&$_POST['category_id']!=''){
			if(uploadImage($sc)){
				$sc->insertData();
			}
		}
	}
	if($_POST['blog-submit']=='update'){
		$sc->setId($_GET['id']);
		if(uploadImage($sc)){
			$sc->update();
		}
	}
}
function uploadImage($obj){
	$target_dir = "uploads/";
	if(!file_exists($target_dir)){
		mkdir($target_dir);
	}
	$basename = basename($_FILES["image"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($basename,PATHINFO_EXTENSION));
	$target_file = $target_dir . str_replace(' ', '-', $obj->getTitle()) . strtotime(date('Y-m-d h:m:s')) . '.' . $imageFileType;

	// Check if image file is a actual image or fake image
	if(isset($_POST["save"])) {
	  $check = getimagesize($_FILES["image"]["tmp_name"]);
	  if($check !== false) {
	    $uploadOk = 1;
	  } else {
	  	echo 'sizeIssue';
	    return false;
	  }
	}

	// Check if file already exists
	if (file_exists($target_file)) {
	  echo 'alreadyIssue';
	  return false;
	}

	// Check file size
	if ($_FILES["image"]["size"] > 50000000) {
	  echo 'sizeIssue';
	  return false;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
      echo 'extentionIssue';
	  return false;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  return false;
	} else {
	  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	  	$obj->setImage($target_file);
	  	return true;
	  }
	}
}