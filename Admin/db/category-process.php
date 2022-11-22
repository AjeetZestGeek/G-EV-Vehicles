<?php 
require_once('category.php');
$type = 'save';
$class = 'btn btn-primary';
if (isset($_GET['id'])&&isset($_GET['req'])&&isset($_GET['page'])&&$_GET['page']=='category') {
	if($_GET['req']=='edit'){
		$type = 'update';
		$class = 'btn btn-warning';
		$sc = new category();
		$sc->setId($_GET['id']);
		$data = $sc->fetchOne()[0];
	}
	if($_GET['req']=='delete'){
		$sc = new category();
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
if (isset($_POST['submit'])) {
	$sc = new category();
	$sc->setTitle($_POST['title']);
	if($_POST['submit']=='save'){
		$sc->setCreatedBy($_POST['user_id']);
		if($_POST['title']!=''){
			$sc->insertData();
		}
	}
	if($_POST['submit']=='update'){
		$sc->setId($_GET['id']);
		$sc->update();
	}
}