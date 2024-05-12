<?php require '../layouts/header.php' ?>  
<?php require '../../config/config.php' ?>    

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>

<?php 
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo $email;
        if($email=='' OR $password == ''){
            echo 'Something is missing';
        }else{
            $login = $conn->prepare("SELECT * FROM admins WHERE email='$email'");
            $login->execute();
            $data = $login->fetch(PDO::FETCH_ASSOC);
        
            if($login->rowCount()>0){
                if(password_verify($password,$data['password'])){
                    $_SESSION['adminname']=$data['adminname'];
                    $_SESSION['id']=$data['id'];
                    header('location: ../index.php');
                }else{
                  echo "Incorrect Password";
                }
            }
        }
      }

?>


              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>
    </div>
    <?php require '../layouts/footer.php' ?>   