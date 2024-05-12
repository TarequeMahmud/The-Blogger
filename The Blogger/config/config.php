<?php
$dbname= 'cleanblog';
$host='127.0.0.1';
$user= 'clean';
$password='';

$conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);

if($conn==true){
}else{
    echo "connection failed";


}




?>