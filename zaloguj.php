<?php

session_start();
	
if ((!isset($_POST['uzytkownik'])) || (!isset($_POST['haslo'])))
{
	$_SESSION['blad'] = '<span style="color:red">Podaj użytkownika i hasło!</span>';
    header('Location: index.php');
	exit();
} else 
        {

        if (($_POST['haslo']=="") || ($_POST['uzytkownik']==""))
            {
                $_SESSION['blad'] = '<span style="color:red">Podaj użytkownika i hasło!</span>';
                header('Location: index.php');
                exit();

            }
        }




if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true)) {

		header('Location: glowna.php');
		exit();
	}
    else {

            require_once "database.php";
            $uzytkownik = ltrim(rtrim($_POST['uzytkownik']));
            $_SESSION['uzytkownik'] = ltrim(rtrim($_POST['uzytkownik']));
            $haslo = ltrim(rtrim($_POST['haslo']));
            $_SESSION['haslo1'] = ltrim(rtrim($_POST['haslo1']));
        
            $usersQuery = $conn->prepare("SELECT * FROM uzytkownicy WHERE uzytkownik = '$uzytkownik' AND haslo = '$haslo'");

            $usersQuery->execute();
            
            $user = $usersQuery->fetch();

            $uzyt_db = ltrim(rtrim($user['uzytkownik']));
            $haslo_db = ltrim(rtrim($user['haslo']));
        
            if($uzytkownik==$uzyt_db && $haslo==$haslo_db)
                {

                    $imie = ltrim(rtrim($user['imie']));
                    $_SESSION['imie'] = ltrim(rtrim($user['imie']));
                
                    $nazwisko = ltrim(rtrim($user['nazwisko']));
                    $_SESSION['nazwisko'] = ltrim(rtrim($user['nazwisko']));
                
                    $_SESSION['typ'] = ltrim(rtrim($user['typ']));
                    $_SESSION['wybrany_tryb'] = 'U';

                
                    //Zapis logowania do bazy danych
                    $imie = ltrim(rtrim($_SESSION['imie']));                
                    $nazwisko = ltrim(rtrim($_SESSION['nazwisko']));
                    $WeWy = 'In';
                    $uzytkownik = $_SESSION['uzytkownik'];
                    $adres = $_SERVER['REMOTE_ADDR'];
                    require_once "database.php";
                    $usersQuery = $conn->prepare("INSERT INTO Logowania (Imie, Nazwisko, WeWy, Uzytkownik, adres) VALUES ('$imie', '$nazwisko', '$WeWy', '$uzytkownik', '$adres')");
                    $usersQuery->execute();
                    $usersQuery->nextRowset();
                    $user = $usersQuery->fetch();
                
                
                
                
                
                
                
                
                
                    //echo ">>>".$uzytkownik ."<<< ". " >>>" . $haslo. "<<< " . $imie. " " . $nazwisko;
                    unset($_SESSION['blad']);
                    $_SESSION['zalogowany']=true;
                    header('Location: glowna.php');
                    exit();
                


                } else {

                        $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy użytkownik lub hasło!</span>';
                        $_SESSION['zalogowany']=false;
                        header('Location: index.php');
                        exit();
                        }
        }

	
?>