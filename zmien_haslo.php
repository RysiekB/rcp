<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
    if (isset($_POST['haslo1']) || isset($_POST['haslo2']))
    {
        
		//Udana walidacja? Założenie TAK
		$wszystko_OK=true;
        
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
        $uzytkownik = $_SESSION['uzytkownik'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

        if ($wszystko_OK==true)
        {
            try 
            {

                require_once "database.php";
                $haslo = ltrim(rtrim($_POST['haslo1']));
                $_SESSION['haslo1'] = ltrim(rtrim($_POST['haslo1']));
                $usersQuery = $conn->prepare("UPDATE uzytkownicy SET haslo = '$haslo' WHERE uzytkownik = '$uzytkownik'");
                $usersQuery->execute();
                $user = $usersQuery->fetch();
            }
            catch(Exception $e)
            {
                echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o odwiedziny w innym terminie!</span>';
                //echo '<br />Informacja developerska: '.$e;
            }
                header('Location: zmienione_haslo.php');
                exit();
        }
        
    }
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Kiosk danych</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="icon" href="img/iconmonstr-user-29-16.png" sizes="16x16" type="image/png">
    <link rel="icon" href="img/iconmonstr-user-29-32.png" sizes="32x32" type="image/png">
	    
</head>

<body>
	
	
        
    <div id="glowny">
    
    
    <div id="uzytk">
        <?php
            echo '<span style="font-size: 16px;">Użytkownik:</span> <br />';
            echo $_SESSION['uzytkownik'];
            echo "<br />";
            echo $_SESSION['imie']."  ".$_SESSION['nazwisko']." (".$_SESSION['wybrany_tryb'].")";
        ?>
    </div>

        
    <div id="logo">
         <img src="img/HitachiLogo.jpg">
    </div>
   
    <div style="clear:both;"></div>
        
    <hr>        

        
        <div class="nav">
			<ol>
				<li><a href="glowna.php">Strona główna</a></li>
				<li><a href="#">Wejścia/Wyjścia</a>
					<ul>
                        <?php
                            switch ($_SESSION['wybrany_tryb'])
                            {
                            case "U":
                                echo '<li><a href="bramki_tydzien.php">Bieżący tydzień</a></li>';
                                echo '<li><a href="bramki_miesiac.php">Bieżący miesiąc</a></li>';
                                echo '<li><a href="bramki_rok.php">Bieżący rok</a></li>';
                                echo '<li><a href="bramki_rokP.php">Poprzedni rok</a></li>';
                                break;
                            case "A":
                                echo '<li><a href="bramki_tydzien_a.php">Bieżący tydzień</a></li>';
                                echo '<li><a href="bramki_miesiac_a.php">Bieżący miesiąc</a></li>';
                                echo '<li><a href="bramki_rok_a.php">Bieżący rok</a></li>';
                                echo '<li><a href="bramki_rokP_a.php">Poprzedni rok</a></li>';
                                break;
                            case "T":
                                echo '<li><a href="bramki_tydzien_t.php">Bieżący tydzień</a></li>';
                                echo '<li><a href="bramki_miesiac_t.php">Bieżący miesiąc</a></li>';
                                echo '<li><a href="bramki_rok_t.php">Bieżący rok</a></li>';
                                echo '<li><a href="bramki_rokP_t.php">Poprzedni rok</a></li>';
                                break;
                            }
                        ?>
					</ul>
				</li>
				<li><a href="#">Czas pracy</a>
					<ul>
                        <?php
                            switch ($_SESSION['wybrany_tryb'])
                            {
                            case "U":
                                echo '<li><a href="wewy_tydzien.php">Bieżący tydzień</a></li>';
                                echo '<li><a href="wewy_miesiac.php">Bieżący miesiąc</a></li>';
                                echo '<li><a href="wewy_rok.php">Bieżący rok</a></li>';
                                echo '<li><a href="wewy_rokP.php">Poprzedni rok</a></li>';
                                break;
                            case "A":
                                echo '<li><a href="wewy_tydzien_a.php">Bieżący tydzień</a></li>';
                                echo '<li><a href="wewy_miesiac_a.php">Bieżący miesiąc</a></li>';
                                echo '<li><a href="wewy_rok_a.php">Bieżący rok</a></li>';
                                echo '<li><a href="wewy_rok_aP.php">Poprzedni rok</a></li>';
                                break;
                            case "T":
                                echo '<li><a href="wewy_tydzien_t.php">Bieżący tydzień</a></li>';
                                echo '<li><a href="wewy_miesiac_t.php">Bieżący miesiąc</a></li>';
                                echo '<li><a href="wewy_rok_t.php">Bieżący rok</a></li>';
                                echo '<li><a href="wewy_rok_tP.php">Poprzedni rok</a></li>';
                                break;
                            }
                        ?>

                    </ul>
				</li>
				<li><a href="#">Personalne</a>
					<ul>
						<li><a href="#">Ilość urlopu</a></li>
						<li><a href="#">Nieobecności</a></li>
					</ul>
				</li>
				<li><a href="#">System</a>
					<ul>
                        <li><a href="raport_pozarowy.php">RAPORT POŻAROWY</a></li>
						<li><a href="zmien_haslo.php">Zmiana hasła</a></li>
                        <li><a href="zmien_tryb.php">Zmiana trybu pracy</a></li>
					</ul>
				</li>
				<li><a href="logout.php">Wyloguj</a></li>
			</ol>
		
		</div>
        <div style="clear:both;"></div>
        <div class="glowneokno">
        <div class="container">
            <form method="post">
        
              <p style="font-weight: 700; font-size: 24px">Zmiana hasła </p>
		      Nowe hasło: <br /> <input type="password" name="haslo1"/> <br />
		      Potwierdź:  <br /> <input type="password" name="haslo2"/> <br /><br />
                <?php
                    if (isset($_SESSION['e_haslo']))
			         {
				        echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				        unset($_SESSION['e_haslo']);
			         }
		          ?>
                <input type="submit" value="Zapisz nowe hasło" class="przycisk"/>
	
	       </form>
        </div>
   
        
        </div>
        <div style="clear:both;"></div>
        <div class="stopka">
            <a href="http://www.hitachi-automotive.co.jp/en/" target="_blank">Hitachi Atomotive</a>
            <a href="https://cbigroup.sharepoint.com" target="_blank">Sharepoint CBI</a>
         </div>
		
    </div>
    
    
    
    
</body>
</html>