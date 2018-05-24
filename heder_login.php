<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div id='header'>
    <div class="clear" id="text">
    <?php
    if(isset($_SESSION['error'])){
    ?>

        <?php
        echo $_SESSION['error'];
        session_unset($_SESSION['error']);
    }else{
         if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'] ."</a>";
                    session_unset($_SESSION['message']);
        }else{
        ?>
        <a>Podaj Swój login i hasło</a>
        <?php
        }
    }
?>

    </div></div>