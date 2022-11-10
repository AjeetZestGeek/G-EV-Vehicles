<?php 
require_once('user-config.php');
$type = 'save';
$class = 'btn btn-primary';
if (isset($_GET['id'])&&isset($_GET['req'])) {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn btn-warning';
		$sc = new userConfig();
		$sc->setId($_GET['id']);
		$data = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new userConfig();
		$sc->setId($_GET['id']);
		$data = $sc->delete();
	}
}
if (isset($_POST['submit'])) {
	$sc = new userConfig();
	$sc->setUsername($_POST['username']);
	$sc->setEmail($_POST['email']);
	$sc->setPhone($_POST['phone']);
	if($_POST['submit']=='save'){
		if($_POST['pwd']==$_POST['conpwd']){
			$sc->setPassword($_POST['pwd']);
		}else{
			$msg = "Password and Confirm Password are not matched";
			header('Location:signup.php');
		}
		$sc->insertData();
	}
	if($_POST['submit']=='update'){
		$sc->setId($_GET['id']);
		$sc->update();
	}
}