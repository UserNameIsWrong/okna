<?php
require_once 'Class.php';
session_start();

//sprawdzenie czy jest zalogowany urzytkownik
if(!registerer::isLogged()){
    header("location: index.php?id=login");
}

$to_rem=$_POST['to_rem'];
$db= baza_mysql::conect_to_db(); //połączenie z bazą danych
$query= "DELETE FROM okna.wpisy WHERE id='$to_rem'";
if(!$db->query($query)){
 $_SESSION['error']="Wystąpił problem spóbuj jeszcze raz";
 header("location: index.php");
}
header('location: index.php');
?>
