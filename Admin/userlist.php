<?php 
require_once('header.php');
require_once('db/addUserProcess.php');
$sc = new userConfig();
$record = $sc->fetchAll();
?>
<div class="row align-items-center main-row-sec">
	<div class="col-md-6"> 
		<div class="blog-list"> 
			<h5>User List</h5>
		</div>
	</div>
	<div class="col-md-6"> 
		<div class="blog-btn">	
			<a href="addUser.php" class="btn btn-primary">Add</a>
		</div>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th scope="col">Sl no.</th>
			<th scope="col">Phone</th>
			<th scope="col">User Name</th>
			<th scope="col">Email</th>
			<th scope="col">Status</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sl = 0; 
		foreach ($record as $key => $value) { 
			?>
		<tr>
			<th scope="row"><?=++$sl;?></th>
			<td><?=$value['username'];?></td>
			<td><?=$value['phone'];?></td>
			<td><?=$value['email'];?></td>
			<td><a class="btn btn-<?=$value['status']==0?'primary':'warning';?>" href="addUser.php?id=<?=$value['id'];?>&req=edit"><?=$value['status']==0?'Activate':'Block';?></a></td>
			<td><a class="btn btn-warning" href="addUser.php?id=<?=$value['id'];?>&req=edit"><i class="fa fa-edit"></i></a>&nbsp<a onclick="if (!confirm('It will delete all the data related to this user')){event.stopPropagation(); event.preventDefault();}" class="btn btn-danger" href="?id=<?=$value['id'];?>&req=delete"><i class="fa fa-trash"></i></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php 
require_once('footer.php');
?>