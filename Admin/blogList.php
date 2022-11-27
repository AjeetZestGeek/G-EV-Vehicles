<?php 
require_once('header.php');
require_once('db/category-process.php');
require_once('db/blog-process.php');
$sc = new blog();
$datas = $sc->fetchAll((isset($_GET['page-no'])?$_GET['page-no']:1),(isset($_GET['cat'])?$_GET['cat']:''));
$record = $datas['data'];
$totalPages = $datas['total-page'];
$catObj = new category();
$cats = $catObj->fetchAll();
?>
<div class="row align-items-center main-row-sec">
	<div class="col-md-6"> 
		<div class="blog-list"> 
			<h5>Blog List</h5>
		</div>
	</div>
	<div class="col-md-6"> 
		<div class="blog-btn">	
			<a href="addBlog.php" class="btn btn-primary">Add</a>
		</div>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th scope="col">Sl no.</th>
			<th scope="col">Title</th>
			<th scope="col">
				<form>
					<input type="hidden" name="page-no" value="<?=isset($_GET['page-no'])?$_GET['page-no']:1;?>">
				<select id="category_id" name="cat" onchange="this.form.submit()">
					<option value="">Category</option>
					<?php foreach($cats as $cat){ ?>
					<option <?=isset($_GET['cat'])&&$_GET['cat']==$cat['id']?'selected':''?> value="<?=$cat['id'];?>"><a href="?cat=<?=$cat['id']?>"><?=$cat['title'];?></a></option>
				<?php } ?>
				</select>
				</form>
			</th>
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
			<th scope="row"><a href="blogView.php?id=<?=$value['blog_id'];?>&title=<?=$value['title'];?>"><?=++$sl;?></a></th>
			<td><a href="blogView.php?id=<?=$value['blog_id'];?>&title=<?=$value['blog_title'];?>"><?=$value['blog_title'];?></a></td>
			<td><?=$value['category_title'];?></td>
			<!-- <td></?=$value['content'];?></td> -->
			<td><a href="blogView.php?id=<?=$value['blog_id'];?>&title=<?=$value['blog_title'];?>"><img src="<?=$value['image'];?>"  width="150px" height="80"></a></td>
			<td><?=$value['blog_created_date'];?></td>
			<?php $cb = new blog(); 
				  $cb->setId($value['blog_id']);
				  $username = $cb->fetchCreatedBy()['username'];
			?>
			<td><?=$username;?></td>
			<!-- Status -->
			<td><a class="btn btn-<?=$value['blog_status']==0?'primary':'warning';?>" href="?page=blog&id=<?=$value['blog_id'];?>&req=update-status&val=<?=$value['blog_status']==0?1:0;?>"><?=$value['blog_status']==0?'Activate':'Block';?></a></td>
			<!-- Action -->
			<td><a class="btn btn-warning" href="addBlog.php?page=blog&id=<?=$value['blog_id'];?>&req=edit"><i class="fa fa-edit"></i></a>&nbsp<a onclick="if (!confirm('Are you sure to delete ?')){event.stopPropagation(); event.preventDefault();}" class="btn btn-danger" href="?page=blog&id=<?=$value['blog_id'];?>&req=delete"><i class="fa fa-trash"></i></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="?page-no=<?=(isset($_GET['page-no'])&&$_GET['page-no']>1)?$_GET['page-no']-1:1?>&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==1)?'active':''?>" href="?page-no=1&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>">1</a></li>...

    <?php for ($i=((isset($_GET['page-no'])&&$_GET['page-no']-2>1)?$_GET['page-no']-2:2); $i < $totalPages && $i < (isset($_GET['page-no'])?$_GET['page-no']+3:3); $i++) { ?>

        <li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==$i)?'active':''?>" href="?page-no=<?=$i;?>&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>"><?=$i;?></a></li>

    <?php } 
    if($totalPages!=1){
    ?>
        ...<li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==$totalPages)?'active':''?>" href="?page-no=<?=$totalPages;?>&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>"><?=$totalPages;?></a></li>

    <?php } ?>
    <li class="page-item">
      <a class="page-link" href="?page-no=<?=(isset($_GET['page-no'])&&$_GET['page-no']<$totalPages)?$_GET['page-no']+1:$totalPages?>&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
<?php 
require_once('footer.php');
?>
<script type="text/javascript">
	$(document).ready(function () {
		$('#category_id').change(function(){
		  console.log('hi!');
		});
	});
</script>