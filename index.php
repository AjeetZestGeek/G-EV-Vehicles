<?php 
include 'header.php';
$postObj = new blog();
if(isset($_GET['catId'])){
    $records = $postObj->fetchAll(1,$_GET['catId']);
}else if($_GET['query']){
    $records = $postObj->fetchAll(1,'',$_GET['query']);
}else{
    $records = $postObj->fetchAll(1);
}
$currentPage = (isset($_GET['page-no'])&&$_GET['page-no']>1)?$_GET['page-no']:1;
?>           
<div class="row tm-row">
    <?php foreach($records['data'] as $record){ ?>
    <article class="col-12 col-md-6 tm-post">
        <hr class="tm-hr-primary">
        <a href="post.php?page=comment&blog_id=<?=$record['blog_id'];?>&title=<?=$record['blog_title'];?>" class="effect-lily tm-post-link tm-pt-60">
            <div class="tm-post-link-inner">
                <?php 
                $image = explode('_',$record['image']);
                ?>
                <img src="<?=count($image)==2?'Admin/uploads/'.$image[1]:'img/img-01.jpg'?>" alt="Image" class="img-fluid">                            
            </div>
            <span class="position-absolute tm-new-badge">New</span>
            <h2 class="tm-pt-30 tm-color-primary tm-post-title"><?=$record['category_title'];?></h2>
        </a>                    
        <p class="tm-pt-30">
            <?=$record['blog_title'];?>
        </p>
        <div class="d-flex justify-content-between tm-pt-45">
            <span class="tm-color-primary">Travel . Events</span>
            <span class="tm-color-primary"><?=date_format(date_create($record['blog_created_date']),'F d, Y');?></span>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <span>36 comments</span>
            <span>by <?=ucfirst($record['username']);?></span>
        </div>
    </article>
<?php } ?>
</div>
<div class="row tm-row tm-mt-100 tm-mb-75">
    <div class="tm-prev-next-wrapper">
        <a href="?<?=$_SERVER['QUERY_STRING']?>&page-no=<?=isset($_GET['page-no'])&&$_GET['page-no']>1?$_GET['page-no']-1:1;?>" class="mb-2 tm-btn tm-btn-primary tm-prev-next <?=((isset($_GET['page-no'])&&$_GET['page-no']==1)||$records['total-page']==1)?'disabled':''?> tm-mr-20">Prev</a>
        <a href="?<?=$_SERVER['QUERY_STRING']?>&page-no=<?=isset($_GET['page-no'])&&$_GET['page-no']<$records['total-page']?$_GET['page-no']+1:$records['total-page'];?>" class="mb-2 tm-btn tm-btn-primary tm-prev-next <?=(isset($_GET['page-no'])&&$_GET['page-no']==$records['total-page'])||$records['total-page']==1?'disabled':''?>">Next</a>
    </div>
    <div class="tm-paging-wrapper">
        <span class="d-inline-block mr-3">Page</span>
        <nav class="tm-paging-nav d-inline-block">
            <ul>
                <?php 
                for ($i=$currentPage-4<=1?1:$currentPage-4; $i <= $records['total-page'] && $i <= $currentPage+5; $i++) { 
                ?>
                <li class="tm-paging-item <?=isset($_GET['page-no'])&&$_GET['page-no']==$i?'active':''?>">
                    <a href="?<?=$_SERVER['QUERY_STRING']?>&page-no=<?=$i;?>" class="mb-2 tm-btn tm-paging-link"><?=$i;?></a>
                </li>
            <?php }?>
            </ul>
        </nav>
    </div>                
</div>            
<?php 
include 'footer.php';
?>