<?php 
require_once('category.php');
$type = 'save';
$class = 'btn btn-primary';
if (isset($_GET['id'])&&isset($_GET['req'])) {
	if($_GET['req']=='edit'&&$_GET['page']=='category'){
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