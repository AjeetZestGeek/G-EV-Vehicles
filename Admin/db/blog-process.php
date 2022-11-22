<?php 
require_once('blog.php');
$type = 'save';
$class = 'btn btn-primary';
if (isset($_GET['id'])&&isset($_GET['req'])) {
	if($_GET['req']=='edit'&&$_GET['page']=='blog'){
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
}
if (isset($_POST['blog-submit'])) {
	$sc = new blog();
	$sc->setTitle($_POST['title']);
	$sc->setCategoryId($_POST['category_id']);
	$sc->setContent($_POST['content']);
	$sc->setImage($_POST['image']);
	if($_POST['blog-submit']=='save'){
		$sc->setCreatedBy($_POST['user_id']);
		if($_POST['title']!=''&&$_POST['category_id']!=''){
			// echo '<pre>';print_r($sc);die;
			$sc->insertData();
		}
	}
	if($_POST['blog-submit']=='update'){
		$sc->setId($_GET['id']);
		$sc->update();
	}
}