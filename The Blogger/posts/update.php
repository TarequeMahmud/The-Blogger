<?php require '../includes/header.php'?>
<?php require "../config/config.php"?>
<?php
    if(isset($_GET['upd_id']) AND isset($_SESSION['username'])){
        $id = $_GET['upd_id'];
        $select= $conn->query("SELECT * FROM posts WHERE id='$id'");
        $select->execute();

        $rows= $select->fetch(PDO::FETCH_OBJ);

        $categories = $conn->query("SELECT * FROM categories");
        $categories->execute();
        $category = $categories->fetchAll(PDO::FETCH_OBJ);
         


        #update

        if(isset($_POST['submit'])){
          
          if($_POST['title']=='' OR $_POST['subtitle']=='' OR !isset($_POST['category_id'])){
            echo 'Something is missing';
          }else{

            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $body = $_POST['body'];
            $category_id = $_POST['category_id'];

            if(isset($_FILES['image']['name']) AND $_FILES['image']['name']!=''){
              unlink("images/".$rows->img."");
              $img = $_FILES['image']['name'];
              $dir= 'images/'.basename($img);

            if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)){  
              $post= $conn->prepare("UPDATE posts SET title=:title, subtitle=:subtitle, body=:body, category_id = :category_id, img=:img WHERE id='$id'");
              $post->execute([
                ':title'=>$title,
                ':subtitle'=>$subtitle,
                ':body'=>$body,
                'category_id'=>$category_id,
                ':img'=>$img,
              
              ]);
                header("location: post.php?post_id=$rows->id");  
              }}
              else{
                $post= $conn->prepare("UPDATE posts SET title=:title, subtitle=:subtitle, body=:body, category_id = :category_id WHERE id='$id'");
                $post->execute([
                  ':title'=>$title,
                  ':subtitle'=>$subtitle,
                  ':body'=>$body,
                  'category_id'=>$category_id,
                ]);
                  header("location: post.php?post_id=$rows->id"); 
              }
            }
          }}


?>

            <form method="POST" action="update.php?upd_id=<?php echo $rows->id?>"  enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" value="<?php echo $rows->title?>" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" value="<?php echo $rows->subtitle?>" class="form-control" placeholder="subtitle" />
            </div>

            <div class="form-outline mb-4">
              <select name="category_id" class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <?php foreach($category as $cat) :?>
                <option value="<?php echo $cat->id?>"><?php echo $cat->name;?></option>
                <?php endforeach;?>
              </select>
            </div>

              <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1"  class="form-control" placeholder="body"><?php echo $rows->body;?></textarea>
            </div>

              
             <div class="form-outline mb-4">
                <?php echo "<img src='images/".$rows->img."' width=300 height=400>" ?>
                <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
            </form>

<?php require '../includes/footer.php'?>