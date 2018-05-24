<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Class.php';
session_start();
//sprawdzenie czy jest zalogowany urzytkownik
if(!registerer::isLogged()){
    $_SESSION['error']= "Proszę się zalogować";
    header("location: index.php?id=login");
    exit;
}elseif (!registerer::isGoodReferer('add.php')) //sprawdzenie czy zachowano kolejność kroków(poprawna poprzednia strona)
{
    header('location: index.php?id=add');
    exit;
}

if($_POST['if']=="TAK") {
    $title = $_SESSION['wpis']['title'];
    $image = $_SESSION['wpis']['image'];
    $text = $_SESSION['wpis']['text'];
    $wpis_date = $_SESSION['wpis']['wpis_date'];
    $autor_id = $_SESSION['wpis']['autor_id'];
    $autor_name= $_SESSION['wpis']['autor_name'];

    $db = baza_mysql::conect_to_db();
    $query = "insert into okna.wpisy set title='$title', image='$image', wpis='$text', wpis_date='$wpis_date', autor_id='$autor_id', autor_name='$autor_name'";
    if (!$wynik = $db->query($query)) {
        $_SESSION['error'] = "wWystapił problem z bazą danych, spróbuj pózniej";
        $db->close();
        header("location: index.php");
    }
    $db->close();
    header("location: index.php");
} elseif($_POST['if']=="NIE"){
    ?>
    <script type="text/javascript">window.history.go(-2)</script>
    <?php
    exit;
}else{
    header("location: index.php");
}