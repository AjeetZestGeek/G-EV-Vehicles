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
		if($_POST['pwd']==''||$_POST['conpwd']==''||$_POST['username']==''||$_POST['email']==''||$_POST['phone']==''){
		}else{
			if($_POST['pwd']!=$_POST['conpwd']){
				$msg = "Password and Confirm Password are not matched";
			}else{
				$sc->setPassword($_POST['pwd']);
				$sc->insertData();
			}
		}
	}
	if($_POST['submit']=='update'){
		if($_POST['username']==''||$_POST['email']==''||$_POST['phone']==''){

		}else{
			$sc->setId($_GET['id']);
			$sc->update();
		}
	}
}