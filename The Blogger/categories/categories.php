<?php require '../includes/header.php'?>
<?php require '../config/config.php'?>
<?php
    if(isset($_GET['cat_id'])){
        $id= $_GET['cat_id'];

        $select = $conn->query("SELECT * FROM posts WHERE category_id='$id'");
        $select->execute();
        $rows= $select->fetchAll(PDO::FETCH_OBJ);
    }else{
        echo 'error';
    }

?>

            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- <?php echo 'Wellcome '.$_SESSION['username'];?> -->

                    <?php foreach($rows as $row) : ?>
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="posts/post.php?post_id=<?php echo $row->id?>">
                            <h2 class="post-title"><?php echo $row->title; ?></h2>
                            <h3 class="post-subtitle"><?php echo $row->subtitle;?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!"><?php echo $row->username;?></a>
                            <?php echo date('M',strtotime($row->created_at)).','.date('d',strtotime($row->created_at)).' '.date('Y',strtotime($row->created_at));?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Pager-->
                    <?php endforeach;?>
                </div>
            </div>



<?php require "../includes/footer.php"?>