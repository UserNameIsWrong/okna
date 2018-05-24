<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
            <div id='header'>
    <div class="clear" id="text">
                 <?php
                if(registerer::isLogged()){
                 echo "<span id=\"usname\">\"". $_SESSION['user']->name ."\"</span>";
                }
                if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        $_SESSION['error']= null;
    }elseif(isset($_SESSION['message'])) {
                    echo $_SESSION['message'] ."</span>";
                    $_SESSION['message']= null;
         }else{
                if(isset($_GET['id'])){
                    switch ($_GET['id']){
                        case 'login':
                            echo 'Podaj Swój login i hasło';
                            break;
                        case 'Rejestracja':
                            echo 'Rejestracja Użytkownika';
                            break;
                        default :
                            echo 'Witamy na naszej Stronie';
                            break;
                    }
                }else{
                    echo 'Witamy na naszej Stronie';
                }
        }
        ?>
    </div>
            <?php
                if(isset($_SESSION['user'])){    
                    ?>
                    <ul>
    <div class="clear" id="user"><img id="ico" src="/images/user2.png"/>
                        <li><input form="reg" type="submit" name="id" value="Wyloguj"/></li>
                        <li>sdsadad</li>
                        <li>sfdsaf</li>

    </div></ul>
                    <?php
                }else{
                    ?>
                <div class="clear" > <input form="reg" type="submit" name="id" value="login"/>
                    <input form="reg" type="submit" name="id" value="Rejestracja"/> </div>
                <?php
                }                
                ?>
        </div>
