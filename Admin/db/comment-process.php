<?php 
require_once('comment.php');
$type = 'save';
$class = 'btn btn-primary';
if (isset($_GET['id'])&&isset($_GET['req'])&&isset($_GET['page'])&&$_GET['page']=='comment') {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn btn-warning';
		$sc = new comment();
		$sc->setId($_GET['id']);
		$data = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new comment();
		$sc->setId($_GET['id']);
		$data = $sc->delete();
	}
	if($_GET['req']=='update-status'){
		$sc = new comment();
		$sc->setId($_GET['id']);
		$sc->setStatus($_GET['val']);
		$data = $sc->changeStatus();
	}
}
if (isset($_GET['blog_id'])&&isset($_POST['comment-submit'])) {
	$sc = new comment();
	$sc->setName($_POST['name']);
	$sc->setEmail($_POST['email']);
	$sc->setContent($_POST['message']);
	$captcha = $_POST["captcha"];
  $captchaUser = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);
  if(empty($captcha)) {
    $captchaError = array(
      "status" => "alert-danger",
      "message" => "Please enter the captcha."
    );
  }
  else if($_SESSION['CAPTCHA_CODE'] == $captchaUser){
    if($_POST['comment-submit']=='save'){
      if(isset($userId)){
        $sc->setCreatedBy($_POST['user_id']);
      }
      $sc->setBlogId($_GET['blog_id']);
      $sc->insertData();
      $captchaError = array(
        "status" => "alert-success",
        "message" => "Comment added successfuly."
      );
    }else if($_POST['comment-submit']=='update'){
      $sc->setId($_GET['id']);
	  $sc->update();
      $captchaError = array(
        "status" => "alert-success",
        "message" => "Comment updated successfuly."
      );
    }
  }else {
    $captchaError = array(
      "status" => "alert-danger",
      "message" => "Captcha is invalid."
    );
  }
}