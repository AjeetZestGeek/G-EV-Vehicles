<?php 
require_once('header.php');
require_once('db/blog-process.php');
$sc = new blog();
$record = $sc->fetchAll();
?>
<table class="table">
	<thead>
		<tr>
			<th scope="col">Sl no.</th>
			<th scope="col">Title</th>
			<th scope="col">Category</th>
			<th scope="col">Content</th>
			<th scope="col">Image</th>
			<th scope="col">Created At</th>
			<th scope="col">Created By</th>
			<th scope="col">Status At</th>
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
			<td><?=$value['title'];?></td>
			<td><?=$value['category_id'];?></td>
			<td><?=$value['content'];?></td>
			<td><?=$value['image'];?></td>
			<td><?=$value['created_date'];?></td>
			<?php $cb = new blog(); 
				  $cb->setId($value['id']);
				  $username = $cb->fetchCreatedBy()['username'];
			?>
			<td><?=$username;?></td>
			<td><a class="btn btn-<?=$value['status']==0?'primary':'warning';?>" href="?id=<?=$value['id'];?>&req=update-status&val=<?=$value['status']==0?1:0;?>"><?=$value['status']==0?'Activate':'Block';?></a></td>
			<td><a class="btn btn-warning" href="addBlog.php?page=blog&id=<?=$value['id'];?>&req=edit"><i class="fa fa-edit"></i></a>&nbsp<a class="btn btn-danger" href="?id=<?=$value['id'];?>&req=delete"><i class="fa fa-trash"></i></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php 
require_once('footer.php');
?>