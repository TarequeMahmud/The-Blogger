<?php require "../includes/header.php"?>
<?php require "../config/config.php"?>
<?php
        if(isset($_POST['submit'])){
          
          if($_POST['title']=='' OR $_POST['subtitle']=='' OR !isset($_POST['category_id'])){
            echo 'Something is missing';
          }else{
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $body = $_POST['body'];
            $category_id = $_POST['category_id'];
            $img = $_FILES['img']['name'];
            $id = $_SESSION['id'];
            $username = $_SESSION['username'];
            $dir= 'images/'.basename($img);
            $post= $conn->prepare("INSERT INTO posts(title, subtitle, body, img, usr_id, category_id, username) VALUES (:title,:subtitle,:body,:img, :id, :category_id, :username)");
            $post->execute([
              ':title'=>$title,
              ':subtitle'=>$subtitle,
              ':body'=>$body,
              ':img'=>$img,
              ':id'=>$id,
              ':category_id'=>$category_id,
              ':username'=>$username
            ]);

            if(move_uploaded_file($_FILES['img']['tmp_name'], $dir)){
              header('location: ../index.php');
            }



          }





        }

        $categories = $conn->query("SELECT * FROM categories");
        $categories->execute();
        $category = $categories->fetchAll(PDO::FETCH_OBJ);


?>



            <form method="POST" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
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
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"></textarea>
            </div>

              
             <div class="form-outline mb-4">
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

          
            </form>

<?php require "../includes/footer.php"?>
           
       