<?php
require_once 'Class.php';
session_start();
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
         <?php
        if(isset($_GET['id'])){
            switch ($_GET['id']){
              case 'add':
                    ?> <link rel="stylesheet" media="all and (min-device-width: 801px)" href="add.css" type="text/css"> 
                       <link rel="stylesheet" media="only screen and (max-device-width: 800px)" href="add.css" type="text/css"><?php
                  break;
              case 'Rejestracja':
                  ?> <link rel="stylesheet" media="all and (min-device-width: 801px)" href="reg.css" type="text/css"> 
                     <link rel="stylesheet" media="only screen and (max-device-width: 800px)" href="phone_reg.css" type="text/css"><?php
                  break;
              case 'login':
                  ?> <link rel="stylesheet" media="all and (min-device-width: 801px)" href="reg.css" type="text/css"> 
                     <link rel="stylesheet" media="only screen and (max-device-width: 800px)" href="phone_reg.css" type="text/css"><?php
                  break;
              default :
                  ?> <link rel="stylesheet" media="all and (min-device-width: 801px)" href="brak_strony.css" type="text/css"> 
                  <link rel="stylesheet" media="only screen and (max-device-width: 800px)" href="brak_strony.css" type="text/css"><?php
                  break;      
            }
        }else{
        ?> <link rel="stylesheet" media="all and (min-device-width: 801px)" href="wpisy.css" type="text/css"> 
             <link rel="stylesheet" media="only screen and (max-device-width: 800px)" href="phone_wpisy.css" type="text/css"><?php
        }
        ?>
            <link rel="stylesheet" media="all and (min-device-width: 801px)" href="heder.css" type="text/css"> 
            <link rel="stylesheet" media="only screen and (max-device-width: 800px)" href="phone_heder.css" type="text/css">
        <?php
        
   if(isset($_SESSION['error'])){
        ?>
             <style>
                 #header{background-color: rgba(255, 0, 0, 0.65);}                
             </style>
             <?php
        }elseif(isset($_SESSION['message'])){
            ?>
             <style>
                 #header{background-color: rgba(0, 255, 0, 0.65);} 
             </style>
             <?php
        }else{
           ?>
             <style>
                 #header{background-color: rgba(120, 120, 120, 0.65);} 
             </style>
             <?php 
        }
             ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <title><?php
            if(isset($_GET['id'])){
                echo $_GET['id'];
            }
            else { echo "Index"; }
        ?></title>
    </head>
    <body>
        <form method="get" id="reg" action="index.php">
          </form>
        <header>
<?php
include_once 'heder.php';
?>
        </header>
        <?php
        if(isset($_GET['id'])){
            switch ($_GET['id']){
              case 'add':
                  include_once 'add.html';
                  break;
              case 'Rejestracja':
                  include_once 'registration.html';
                  break;
              case 'login':
                  include_once 'login.php';
                  break;
              case 'Wyloguj':
                  session_unset($_SESSION['user']);
                  $_SESSION['message']= "Poprawne wylogowanie";
                  ?>
        <script type="text/javascript">location.href="index.php"</script>
        <?php
                  break;
              default :
                  ?>
                <div>STRONA O TYM ADRESIE NIE ISTNIEJE!!!</div>
                <?php
                  break;
            }
        }else{
        include 'wpisy.php';
        }
        ?>
    </body>
</html>
