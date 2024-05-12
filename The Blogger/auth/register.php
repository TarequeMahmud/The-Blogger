<?php require '../includes/header.php'?>
<?php require "../config/config.php"?>


<?php 
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($email=='' OR $password == '' OR $username == ''){
            echo 'Something is missing';
        }else{
            $register = $conn->prepare("INSERT INTO users(email, username, password) VALUES (:email, :username, :password)");
            $register->execute(
                [
                    ':email'=>$email,
                    ':username'=>$username,
                    ':password'=>password_hash($password, PASSWORD_DEFAULT),
                    ]
            );
            header('location:login.php');
        }
    }
?> 

            <form method="POST" action="register.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Aleardy a member? <a href="login.php">Login</a></p>
                

               
              </div>
            </form>

<?php require '../includes/footer.php'?>
       