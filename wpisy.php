<html>

    <body>

        
        <?php
        $db= baza_mysql::conect_to_db(); //połączenie z baza danych
        $query= "select * from okna.wpisy";
        $wynik= $db->query($query);
        while ($row= $wynik->fetch_assoc()){
            ?>
            <div onclick="klik(this)">
                <?php
                if ($row['image'] !=null)
                {
                    echo "<p class=\"tite\">".$row['title']."</p><p><img id='wpis_img' src=\"".$row['image']."\"></p><p>".nl2br($row['wpis'])."</p>"."<p id=\"data\">Dodano dnia: ".$row['wpis_date']." przez: ".$row['autor_name']."</p>";
                }
                else {
                    echo "<p class=\"tite\">".$row['title']."</p><p>".nl2br($row['wpis'])."</p>"."<p id=\"data\">Dodano dnia: ".$row['wpis_date']." przez: ".$row['autor_name']."</p>";
                }
                ?>
                <?php
                if(registerer::islogged()){
                 if($_SESSION['user']->id == $row['autor_id'] || $_SESSION['user']->level > 1) {
                     ?>
                     <form name="remove" action="remove.php" method="post"><span>Usuń Wpis  </span> Na pewno chcesz
                         usunąć ten wpis? JUŻ NIE BEDZIE MOŻLIWE ODZYSKANIE URACONYCH DANYCH !!!!
                         <button type="submit" value="<?php echo $row['id']; ?>" name="to_rem">Tak Usuń</button>
                     </form>
                     <?php
                 }}
                ?>
            </div>
            <div id="close" onclick="zamknij(this)">CLOSE</div>
            <?php
        }


  if(registerer::isLogged()){
        ?>
      <div><a href= "index.php?id=add"><img id="add" src="plus.png"></a></div>
      <?php
       }
       ?>
<script type="text/javascript">
    function klik(th) {
        th.classList.add('wybrany');
        th.id= 'wybrany';
        document.getElementById('close').classList.add('close');
        document.getElementById('newTab').classList.add('close');
    }

    function zamknij(th) {
        document.getElementById('wybrany').classList.remove('wybrany');
        document.getElementById('wybrany').removeAttribute('id');
        th.classList.remove('close')
    }
</script>
    </body>
</html>

