<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div id='header'>
    <?php
    if(isset($_SESSION['error'])){
    ?>
        <a style="font-weight: bold; font-size: 1.2em" >
        <?php
        echo $_SESSION['error'];
        session_unset($_SESSION['error']);
    }else{
         if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'] ."</a>";
                    session_unset($_SESSION['message']);
        }else{
        ?>
        <a>Rejestracja Użytkownika</a>
        <?php
        }
    }
?>
        </a>
</div>