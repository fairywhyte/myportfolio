<?php
include 'process-form.php';

$db_host ='localhost';
$db_username ='root';
$db_password ='rootroot';
$db_database ='portfolio';
//connect to the database
var_dump($_POST);
function db_connect($database)
{
global $db_host;
global $db_password;
global $db_username;

    try
    {  //try connecting to the database
    $pdo_connection= new PDO(
    'mysql:dbname='.$database.';host=' .$db_host.';charset=utf8', // connection information
    $db_username, // username
    $db_password // password
    );
    //set error reporting (for future queries)
    $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e)//if something went wrong in try{}
    {  //output the error message
    echo "Connection failed :". $e->getMessage();
    }
    return $pdo_connection;
}

//build database query
function db_query($query, $values=[])
{
global $db_database;
$pdo =db_connect($db_database);
//prepare the query
$statement =$pdo->prepare($query);

//execute the query
    if(false === $statement->execute($values))
    {
    echo '<h1>MySQL error:</h1>';
    var_dump($pdo->errorInfo());
    exit();
    }
}

if (count($_POST) > 0)
{
//insert validation function for all the input fields
$firstname = filter_input(INPUT_POST, 'firstname') ;
$lastname = filter_input(INPUT_POST, 'lastname');
$email = filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL);
$phone= filter_input(INPUT_POST, 'phone', FILTER_VALIDATE_INT);
$message = filter_input(INPUT_POST, 'message');

    if (!$firstname ||!$lastname|| !$phone || !$email || $message == '')
    {
    header('Location: ?success=no');
    } else {
  //set the query to insert the values into the table
    $query ="
    INSERT INTO `form`(`firstname`,`lastname`, `email`, `phone`, `message`)
    VALUES(?,?,?,?,?)
    ";
    //call the function to execute the query
    db_query($query,[$firstname,$lastname,$email,$phone,$message]);
    $query="SELECT * from `form`";
    db_query($query,$values);

var_dump($_POST);
    header('Location: ?success=yes');
    header('Location: dist/index.html');
    exit();
    }
}
