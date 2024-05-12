<?php require '../includes/header.php'?>
<?php require "../config/config.php"?>


<?php 

if(isset($_GET['profile_id']) AND isset($_SESSION['username'])){
    $id = $_GET['profile_id'];
    $select= $conn->query("SELECT * FROM users WHERE id='$id'");
    $select->execute();

    $rows= $select->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])){
        
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($email=='' OR $password == '' OR $username == ''){
            echo 'Something is missing';
        }else{
            $register = $conn->prepare("UPDATE users SET email=:email, username=:username, password=:password WHERE id='$id' ");
            $register->execute(
                [
                    ':email'=>$email,
                    ':username'=>$username,
                    ':password'=>password_hash($password, PASSWORD_DEFAULT),
                    ]
            );
            header('location:../index.php');
        }
    }
}
?> 

            <form method="POST" action="profile.php?upd_id=<?php echo $id;?>">
           
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" value="<?php echo $rows->email;?>" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" name="username" value="<?php echo $rows->username;?>" id="form2Example1" class="form-control" placeholder="Username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" value="<?php echo password_get_info($rows->password);?>" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>
            



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

              
            </form>

<?php require '../includes/footer.php'?>
       