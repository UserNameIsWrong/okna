<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

        <div id="first">
            <form id="index" action="index.php"></form>
            <form id="action" enctype="multipart" action="user_operation.php" method="post">
                <input type="hidden" name="operation" value="login"/>
                <div class="input">Login<br/><input class="text" type="text" name="name"/></div>
                <div class="input">Hasło<br/><input class="text" type="password" name="password"/></div>
                <p align="center">
                    <input form="index" type="submit" value="Strona główna"/>
                    <input form="action" type="submit" value="Login"/>
                </p>
            </form>
        </div>
<div id="usarr">
    <table>
        <tr>
<?php
$db= baza_mysql::conect_to_db();
baza_mysql::show_users($db);

?>
