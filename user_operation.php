<?php
require_once 'Class.php';
session_start();

if(isset($_POST['operation'])){
$operation = $_POST['operation'];
}else{
    ?>
     <script type="text/javascript">window.history.go(-1)</script>
    <?php 
}

$operator = new registerer;
switch ($operation) {
    case 'save':
        if ($operator->save_user($_POST)) {
            $_SESSION['message']= "Rejstracja zakończona powodzeniem";
            ?>
            <script type="text/javascript">location.href="index.php"</script>
            <?php
            exit;
        } else {
            ?>
            <script type="text/javascript">window.history.go(-1)</script>
            <?php
            }
    case 'change':
        break;
    
    case 'delate':
        break;
    case 'login':
        if($i= $operator->login_user($_POST)){
            $_SESSION['user']= $i;
                      ?>
            <script type="text/javascript">location.href="index.php"</script>
            <?php
        }else{
           ?>
            <script type="text/javascript">window.history.go(-1)</script>
            <?php 
        }  
}
?>
