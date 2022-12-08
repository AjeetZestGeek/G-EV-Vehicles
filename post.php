<?php 
include 'header.php';
if (!isset($_GET['blog_id'])) {
    ?><h1>404</h1><?php
    die;
}
$postObj = new blog();
$postObj->setId($_GET['blog_id']);
$data = $postObj->fetchOne();
if(empty($data)){
    echo '<h1>Nothing is found</h1>';die;
}
$data = $data[0];
$catObj = new category();
$catRecords = $catObj->fetchAll();

$comObj = new comment();
$comRecords = $comObj->fetchAll(1,$_GET['blog_id']);
?>           
<div class="row tm-row">
    <div class="col-12">
        <hr class="tm-hr-primary tm-mb-55">
        <!-- Video player 1422x800 -->
        <!-- <video width="954" height="535" controls class="tm-mb-40">
            <source src="video/wheat-field.mp4" type="video/mp4">							  
            </?/=/$data['blog_title'];?>
        </video> -->
        <?php 
        $image = explode('_',$data['image']);
        if(count($image)==2){
            $image = 'Admin/uploads/'.$image[1];
        }else{
            $image = 'img/img-01.jpg';
        }
        ?>
        <img src="<?=$image?>" width="954" height="535" alt="Blog Image">
    </div>
</div>
<div class="row tm-row">
    <div class="col-lg-8 tm-post-col">
        <div class="tm-post-full">                    
            <div class="mb-4">
                <h2 class="pt-2 tm-color-primary tm-post-title"><?=$data['blog_title'];?></h2>
                <p class="tm-mb-40"><?=date_format(date_create($data['blog_created_date']),'F d, Y');?> posted by <?=ucfirst($data['username']);?></p>
                <p>
                    <?=$data['content'];?>
                </p>
                <span class="d-block text-right tm-color-primary">Creative . Design . Business</span>
            </div>
            
            <!-- Comments -->
            <div>
                <h2 class="tm-color-primary tm-post-title">Comments</h2>
                <hr class="tm-hr-primary tm-mb-45">
                <?php 
                foreach($comRecords['data'] as $comRecord){
                ?>
                <div class="tm-comment tm-mb-45">
                    <figure class="tm-comment-figure">
                        <img src="img/comment-1.jpg" alt="Image" class="mb-2 rounded-circle img-thumbnail">
                        <figcaption class="tm-color-primary text-center"><?=$comRecord['com_name'];?></figcaption>
                    </figure>
                    <div>
                        <p>
                            <?=$comRecord['content'];?>
                        </p>
                        <div class="d-flex justify-content-between">
                            <!-- <a href="#" class="tm-color-primary">REPLY</a> -->
                            <span class="tm-color-primary"><?=date_format(date_create($comRecord['com_created_date']),'F d, Y');?></span>
                        </div>                                                 
                    </div>                                
                </div>
            <?php } ?>
                <form action="" method="post" class="mb-5 tm-comment-form">
                    <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                    <div class="mb-4">
                        <input class="form-control" name="name" type="text" placeholder="Name">
                    </div>
                    <div class="mb-4">
                        <input class="form-control" name="email" type="text" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control" name="message" rows="6" placeholder="Message"></textarea>
                    </div>
                    <div class="mb-4">
                        <img src="captcha.php" alt="PHP Captcha" width="360" height="75" style="margin-top: 15px;">
                    </div>
                    <div class="mb-4">
                        <input class="form-control" name="captcha" id="captcha" type="text" placeholder="Enter Captcha">
                    </div>
                    <?php if(!empty($captchaError)) {?>
                        <div class="mb-4 text-center">
                          <div class="alert text-center <?php echo $captchaError['status']; ?>">
                            <?php echo $captchaError['message']; ?>
                          </div>
                        </div>
                    <?php }?>
                    <div class="text-right">
                        <button class="tm-btn tm-btn-primary tm-btn-small" type="submit" name="comment-submit" value="save">Submit</button>                        
                    </div>                                
                </form>                          
            </div>
        </div>
    </div>
    <aside class="col-lg-4 tm-aside-col">
        <div class="tm-post-sidebar">
            <hr class="mb-3 tm-hr-primary">
            <h2 class="mb-4 tm-post-title tm-color-primary">Categories</h2>
            <ul class="tm-mb-75 pl-5 tm-category-list">
                <?php 
                foreach($catRecords as $catRecord){
                ?>
                <li><a href="index.php?catId=<?=$catRecord['id']?>&catTitle=<?=$catRecord['title']?>" class="tm-color-primary"><?=$catRecord['title']?></a></li>
            <?php } ?>
            </ul>
            <hr class="mb-3 tm-hr-primary">
            <h2 class="tm-mb-40 tm-post-title tm-color-primary">Related Posts</h2>
            <a href="#" class="d-block tm-mb-40">
                <figure>
                    <img src="img/img-02.jpg" alt="Image" class="mb-3 img-fluid">
                    <figcaption class="tm-color-primary">Duis mollis diam nec ex viverra scelerisque a sit</figcaption>
                </figure>
            </a>
            <a href="#" class="d-block tm-mb-40">
                <figure>
                    <img src="img/img-05.jpg" alt="Image" class="mb-3 img-fluid">
                    <figcaption class="tm-color-primary">Integer quis lectus eget justo ullamcorper ullamcorper</figcaption>
                </figure>
            </a>
            <a href="#" class="d-block tm-mb-40">
                <figure>
                    <img src="img/img-06.jpg" alt="Image" class="mb-3 img-fluid">
                    <figcaption class="tm-color-primary">Nam lobortis nunc sed faucibus commodo</figcaption>
                </figure>
            </a>
        </div>                    
    </aside>
</div>
<?php 
include 'footer.php';
?>