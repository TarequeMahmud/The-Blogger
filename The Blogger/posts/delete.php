<?php require '../config/config.php'?>
<?php
    if(isset($_GET['del_id'])){
        $del_id = $_GET['del_id'];
        $select = $conn->prepare("SELECT * FROM posts WHERE id='$del_id' ");
        $select->execute();
        $post= $select->fetch(PDO::FETCH_OBJ);
        unlink("images/".$post->img."");
        $delete = $conn->prepare("DELETE FROM posts WHERE id='$del_id'");
        $delete->execute();
        header('location: ../index.php');
    }

?>