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
			if(uploadImage($sc,'save')){
				$sc->insertData();
			}
		}
	}
	if($_POST['blog-submit']=='update'){
		$sc->setId($_GET['id']);
		if(uploadImage($sc,'update')){
			$sc->update();
		}
	}
}
function uploadImage($obj,$action){
	$imageProcess = 0;
	if(is_array($_FILES)&&!empty($_FILES['image']['tmp_name'])) {
	    $fileName = $_FILES['image']['tmp_name'];
	    $srcProperties = getimagesize($fileName);
	    $resizeFileName = time();
	    $path = "./uploads/";
	    if(!file_exists($path)){
	    	mkdir($path);
	    }
	    $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	    $uploadImageType = $srcProperties[2];
	    $srcWidth = $srcProperties[0];
	    $srcHeight = $srcProperties[1];
	    switch ($uploadImageType) {
	        case IMAGETYPE_JPEG:
	            $resrcType = imagecreatefromjpeg($fileName); 
	            $imageLayer = resizeImage($resrcType,$srcWidth,$srcHeight);
	            imagejpeg($imageLayer,$path."thump_".$resizeFileName.'.'. $fileExt);
	            $imageProcess = 1;
	            break;

	        case IMAGETYPE_GIF:
	            $resrcType = imagecreatefromgif($fileName); 
	            $imageLayer = resizeImage($resrcType,$srcWidth,$srcHeight);
	            imagegif($imageLayer,$path."thump_".$resizeFileName.'.'. $fileExt);
	            $imageProcess = 1;
	            break;

	        case IMAGETYPE_PNG:
	            $resrcType = imagecreatefrompng($fileName); 
	            $imageLayer = resizeImage($resrcType,$srcWidth,$srcHeight);
	            imagepng($imageLayer,$path."thump_".$resizeFileName.'.'. $fileExt);
	            $imageProcess = 1;
	            break;

	        case IMAGETYPE_JPG:
	            $resrcType = imagecreatefrompng($fileName); 
	            $imageLayer = resizeImage($resrcType,$srcWidth,$srcHeight);
	            imagepng($imageLayer,$path."thump_".$resizeFileName.'.'. $fileExt);
	            $imageProcess = 1;
	            break;

	        default:
	            $imageProcess = 0;
	            break;
	    } 
	}
	if($imageProcess == 0 && $action=='update'){
    	$obj->setImage($obj->getImage());
    	$imageProcess = 1;
    }else{
	    move_uploaded_file($fileName, $path. $resizeFileName. ".". $fileExt);
	    $obj->setImage($path."thump_".$resizeFileName.'.'. $fileExt);
	    $imageProcess = 1;
	}
	return $imageProcess;
}
function resizeImage($resourceType,$width,$height,$resizeWidth = 150,$resizeHeight = 100 ) {
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $width,$height);
    return $imageLayer;
}