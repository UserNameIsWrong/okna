<?php
date_default_timezone_set('Europe/Warsaw') ;

      
interface obsługa_user{
    function save_user (array $post);
    function login_user (array $post);
   // function change_user(user $log_user, array $post);
    //function del_user(user $log_user, array $post);
}

class user{
    public $id;
    public $name;
    public $reg_date;
    public $level;
    //public $wpisy;
    
    function __construct(array $log_array) {
             $this->id= $log_array['0'];
             $this->name= $log_array['1'];
             $this->reg_date= $log_array['2'];
             $this->level= $log_array['3'];
    }
    
    public function show(){
        echo "id ".$this->id.": ".$this->name." ".  $this->reg_date." ".$this->level."<br/>";
    }
}
class registerer implements obsługa_user
{


    function save_user(array $post)
    {

        // Połaczenie z Bazą danych
        $db = baza_mysql::conect_to_db();

        // Sprawdzenie nazwy użytkownika
        if (!$post['name']) {
            $_SESSION['error'] = "Podaj Nazwę użytkownika";
            return FALSE;
        }
        $name = $post['name'];
        if ($wynik = $db->query("select name from okna.users where name='$name'")) {
            if ($wynik->num_rows == 1) {
                $_SESSION['error'] = "Wybrana nazwa Użytkownika jest już zajęta wybierz inną";
                $db->close();
                return FALSE;
            }
        } else {
            $_SESSION['error'] = "!!Wystapił problem z bazą danych, spróbuj pózniej";
            $db->close();
            return FALSE;
        }
        $db->close();

        // sprawdzenie poprawnego wpypełnienia pól hasła
        if (!$post['password'] || !$post['password2']) {
            $_SESSION['error'] = "Podaj Hasło";
            return FALSE;
        }
        if (!($post['password'] === $post['password2'])) {
            $_SESSION['error'] = "Hasła nie sa identyczne. Wpisz hasła ponownie";
            return FALSE;
        }
        if (strlen($post['password']) < 6) {
            $_SESSION['error'] = "Hasło musi mieć minimum 6 znaków";
            return FALSE;
        }
        if (!isset($post['level'])) {
            $post['level'] = 1;
        }

        // Połaczenie z Bazą danych
        $db = baza_mysql::conect_to_db();

        // Zapisanie użytkownika w bazie danych
        $name = $post['name'];
        $password = password_hash($post['password'], PASSWORD_BCRYPT);
        $level = $post['level'];
        $query = "insert into okna.users set" .
            " name='$name', " .
            " password='$password'";
        if ($post['level']) {
            $query .= ", level=$level";
        }
        if (!$wynik = $db->query($query)) {
            $_SESSION['error'] = "Wystapił problem z bazą danych, spróbuj pózniej";
            $db->close();
            return FALSE;
        }

        // Koniec funkcji save_user()
        $db->close();
        return TRUE;
    }


    function login_user(array $post)
    {

        //sprawdzenie poprawnego wypełnienia pól
        if (!$post['name']) {
            $_SESSION['error'] = "NIE WPISANO LOGINU!";
            return FALSE;
        }
        if (!$post['password']) {
            $_SESSION['error'] = "NIE WPISANO HASŁA!";
            return FALSE;
        }

        $db = baza_mysql::conect_to_db(); //połaczenie z baza danych

        //sprawdzeni danych logowania
        $name = $post['name'];
        $pass = $post['password'];
        $query = "select name, password from okna.users where name='$name'";
        $wynik = $db->query($query);
        $row= $wynik->fetch_assoc();
        if ($wynik->num_rows == 1 && password_verify($pass, $row['password']) == true) {
                $query = "select Id, name, reg_date, level from okna.users where name='$name'";
                $wynik= $db->query($query);
            while ($row = $wynik->fetch_row()) {
                $i = 0;
                foreach ($row as $r) {
                    $user_log[$i] = $r;
                    $i++;
                }
            }
            $db->close();
            $user = new user($user_log);
            return $user;
        } else {
            $_SESSION['error'] = "Wybrana nazwa urzytkownika lub hasło są niepoprawne";
            $db->close();
            return FALSE;
        }
    }

    //sprawdza czy użytkownik jest zalogowany
    public static function isLogged()
    {
        if (isset($_SESSION['user']) && is_a($_SESSION['user'], 'user')) {
            $name = $_SESSION['user']->name;
            $id = $_SESSION['user']->id;
            $reg_date = $_SESSION['user']->reg_date;
            $db = baza_mysql::conect_to_db();
            $query = "select name from okna.users where name='$name' && Id='$id' && reg_date='$reg_date'";
            if($wynik = $db->query($query)){
            $ile= $wynik->num_rows;
            if ($ile != 1) {
                $db->close();
                return false;
            }
            }
        } else {
            return false;
        }
        $db->close();
        return true;
    }

    public static function isGoodReferer($previousPage){
        if($_SERVER['HTTP_REFERER']== "http://".$_SERVER['SERVER_NAME']."/".$previousPage
            && $_SERVER['REQUEST_METHOD']== "POST" && $_POST['token'] == "bdhsadf238rhf83f32fr3y8df1hr3rf3gfr23c4y8tyq3x"){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

class baza_mysql{
    public static function conect_to_db()
    {
        $db = new mysqli("localhost", "Kortez", "kortez");
        if ($db->connect_errno) {
            $_SESSION['error'] = "!!Wystapił problem z bazą danych, spróbuj pózniej";
            $db->close();
            return FALSE;
        } else {
            return $db;
        }
    }

    function show_users(mysqli $db){
$db= baza_mysql::conect_to_db();
$wynik= $db->query("select * from okna.users");
$w= $wynik->fetch_assoc();
foreach ($w as $key=>$val){
    echo "<td>$key</td>";
}
echo "</tr><tr>";
$wynik= $db->query("select * from okna.users");
while ($w= $wynik->fetch_row()){
    foreach ($w as $val){
        echo "<td>$val</td>";
    }
    echo "</tr>";
}
?>
</table>
</div>
<?php
    }
}

?>
