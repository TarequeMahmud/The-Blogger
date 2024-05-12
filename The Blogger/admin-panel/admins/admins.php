<?php require '../layouts/header.php' ?>  
<?php require '../../config/config.php' ?>   

<?php


    $select = $conn->query("SELECT * FROM admins");
    $select->execute();
    $datas = $select->fetchAll(PDO::FETCH_ASSOC);
 

?>

      <div class="row">
        <div class="col mt-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="create-admins.html" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($datas as $data) : ?>
                  <tr>
                    <th scope="row"><?php echo $data['id'];?></th>
                    <td><?php echo $data['adminname'];?></td>
                    <td><?php echo $data['email'];?></td>
                   
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php require '../layouts/footer.php'?>     