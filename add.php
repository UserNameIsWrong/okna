<?php
require_once 'Class.php';
session_start();

if(!registerer::isLogged())//sprawdzenie czy jest zalogowany urzytkownik
{
    //$_SESSION['error']= "Proszę się zalogować";
    header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden", true, 403);
    exit;
}elseif(!registerer::isGoodReferer('index.php?id=add')) //sprawdzenie czy zachowano kolejność kroków(poprawna poprzednia strona)
{
    header('location: index.php?id=add');
    exit;
}

?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{background-color: lightgray}
            div{width: 80%; height: 80vh; overflow: scroll; background-color: white; }
            p{margin: 2%}
            p.tite {margin: 0.7vh; text-align: center; font-weight: bold; font-size: 1.3em; background-color:  lightblue; left: 0 }
            img {position: relative; width: 35%; height: auto; margin-bottom: 2%}
            #data{text-align: right; color: #474747; margin-top: 5%; font-style: oblique; font-size: 0.9em}           
        </style>
    </head>
</html>


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$max_rozm= 20480000;
date_default_timezone_set('Europe/Warsaw') ;
$title= htmlspecialchars(strtoupper($_POST['title']));
$image= null;
$text= htmlspecialchars($_POST['text']);
$data= date('Y F jS H:i');
$autor_id= null;
$autor_name= null;


$autor_id= $_SESSION['user']->id;
$autor_name= $_SESSION['user']->name;

//sprawdzenie czy jest tytuł
if(!$_POST['title']){
    $_SESSION['error']= "Proszę wpisać Tytuł";
     ?>
<script type="text/javascript">window.history.go(-1)</script>
<?php
     exit;
}

//sprawdzenie czy obraz został wysłany i poprawnośći obrazu
//jeśli ok ustawienie ścieki i nazwy obrazu
if (is_uploaded_file($_FILES['obrazek']['tmp_name']))
{
    if($_FILES['obrazek']['error']>0) //sprawdzenie błędów
    {
        $_SESSION['error']= "Wystąpił nieoczekiwany błąd !!! Spróbój ponownie";
        ?>
        <script type="text/javascript">window.history.go(-1)</script>
        <?php
        exit;
    }
    if($_FILES['obrazek']['type']!='image/gif' & $_FILES['obrazek']['type']!='image/jpeg' &
      $_FILES['obrazek']['type']!='image/jpg' & $_FILES['obrazek']['type']!='image/png') //sprawdzenie typu
    {
        $_SESSION['error']= "Dozwolone pliki to .jpg .jpeg .gif .png";
        ?>
        <script type="text/javascript">window.history.go(-1)</script>
        <?php
        exit;
    }
    if($_FILES['obrazek']['size']>$max_rozm) //sprawdzenie rozmiaru
    {
        $_SESSION['error']= "Plik jest zbyt duży !!! Maksymalny rozmiar to".$max_rozm."B";
        ?>
        <script type="text/javascript">window.history.go(-1)</script>
        <?php
        exit;
    }
    $czy_zdjecie= 1;
    $image= name(); //zwrócenie ścieżki dostępu z nazwą obrazu (można podać wybraną ściężkę  do katalogu z obrazami)
}else {
        $czy_zdjecie= 0;
        echo "Nie dodano zdjęcia lub plik jest zbyt duży. Maksymalny rozmiar to".$max_rozm."B" ;
    }

    if($czy_zdjecie==1){
    if(!move_uploaded_file($_FILES['obrazek']['tmp_name'], $image))
{
$_SESSION['error']= "Wystąpił błąd przy zapisie. Spróbuj jeszcze raz";
    ?>
    <script type="text/javascript">window.history.go(-1)</script>
    <?php
    exit;
}
}

    //przygotowanie wpisu do wysłania do bazy
$_SESSION['wpis']['title']= $title;
$_SESSION['wpis']['image']= $image;
$_SESSION['wpis']['text']= $text;
$_SESSION['wpis']['wpis_date']= $data;
$_SESSION['wpis']['autor_id']= $autor_id;
$_SESSION['wpis']['autor_name']= $autor_name;

//Kontrolne wyświetlenie wpisu
if ($czy_zdjecie==1)
{
$wpis= "<p class=\"tite\">".$title."</p><p><image src=\"".$image."\"></p><p>".nl2br($text)."</p>"."<p id=\"data\">Dodano dnia: ".$data." przez: ".$autor_name."</p>";
}
 else {
 $wpis= "<p class=\"tite\">".$title."</p><p>".nl2br($text)."</p>"."<p id=\"data\">Dodano dnia: ".$data." przez: ".$autor_name."</p>";
}
echo "<body><p><b>TAK BEDYIE WYGLĄDAŁ TWÓJ WPIS:<br/></b></P>";
echo "<div>".$wpis. "</div>";
echo "<br/><form action=\"add2.php\" method=\"post\">
<input type=\"hidden\" name=\"token\" value=\"bdhsadf238rhf83f32fr3y8df1hr3rf3gfr23c4y8tyq3x\">
<button name='if' value=\"NIE\">Dokonaj Zmian</button> <button name=\"if\" value=\"TAK\">Zatwierdź i Wyślij</button>
</form>
</body>";


/**
 * @return string
 */
function name($path="wpisy/")
{
    $typ= null;
    switch ($_FILES['obrazek']['type'])
{
    case 'image/gif':
        $typ= ".gif";
        break;
    case 'image/jpeg':
        $typ= ".jpeg";
        break;
    case 'image/jpg':
        $typ= ".jpg";
        break;
    case 'image/png':
        $typ= ".png";
        break;
}
    $name=1;
    $pic_path= $path.$name.$typ;
while(file_exists($path.$name.$typ)){
    $name++;
    $pic_path= $path.$name.$typ;
}
return $pic_path;
}



function newfile(){
$file= "c:/xampp/htdocs/WWW/Okna/wpisy/";
$d= date('Y F jS H i');
$file= $file.$d;
if (file_exists($file.".html"))
{
    $file=$file."_";
    $i=1;
    $typ=".html";
    while (file_exists($file.$i.$typ)){ $i++; }   
    $file= $file.$i.".html";
}
 else    
 {
  $file= $file.".html";
 }
 return $file;
}
?>
