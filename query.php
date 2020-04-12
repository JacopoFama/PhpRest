<?php
//parametri connessione database
$_dbHostname = "localhost:3306";
$_dbName = "FI_ITIS_MEUCCI";
$_dbUsername = "root";
$_dbPassword = "";
$_con = new PDO("mysql:host=$_dbHostname;dbname=$_dbName", $_dbUsername, $_dbPassword);
$_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$_con->exec('SET NAMES utf8');


if($_GET['id']) { // http://localhost/query.php?id=105
    // se passato il parametri id cerca per id
    $id = $_GET['id']; //metti nella variabile $id il valore del parametro id <- (105)
    $sql = "SELECT * FROM student WHERE id=:id"; //:id parametro sql
    $stmt = $_con->prepare($sql);
    $params = [
        'id' => $id
    ];
    $stmt->execute($params);
    $data = $stmt->fetch(\PDO::FETCH_ASSOC);
} else { // http://localhost/query.php
    // se non passato il parametri id ritorna tutta la tabella
    $sql = "SELECT * FROM student";
    $stmt = $_con->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
$js_encode = json_encode(array($data), true);

//output
header('Content-Type: application/json');
echo $js_encode;

?>
