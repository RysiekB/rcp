<?php

session_start();


$imie = ltrim(rtrim($_SESSION['imie']));                
$nazwisko = ltrim(rtrim($_SESSION['nazwisko']));
$WeWy = 'Out';
$uzytkownik = $_SESSION['uzytkownik'];
$adres = $_SERVER['REMOTE_ADDR'];


require_once "database.php";
$usersQuery = $conn->prepare("INSERT INTO Logowania (Imie, Nazwisko, WeWy, Uzytkownik, adres) VALUES ('$imie', '$nazwisko', '$WeWy', '$uzytkownik', '$adres')");
$usersQuery->execute();
$usersQuery->nextRowset();
$user = $usersQuery->fetch();


//session_unset();
session_destroy();


header('Location: index.php');

?>
