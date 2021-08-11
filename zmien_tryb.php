<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}


    if (isset($_POST['tryb_pacy']))
    {
        
		//Udana walidacja? Założenie TAK
		$wszystko_OK = true;
        $tryb_pacy = $_POST['tryb_pacy'];
        $typ = $_SESSION['typ'];
        
        switch($typ)
        {
            case 'U':
                $wszystko_OK=false;
                $_SESSION['e-trybpracy'] = "Nie masz uprawnień do zmiany trybu pracy";
                break;
            case 'A':
                if ($tryb_pacy == "T")
                {
                    $wszystko_OK = false;
                    $_SESSION['e-trybpracy'] = "Nie masz możliwości zmiany na ten tryb pracy";
                }
                if ($tryb_pacy == "U") 
                {
                    $_SESSION['wybrany_tryb'] = 'U';
                    $wszystko_OK = true;
                }
                if ($tryb_pacy == "A") 
                {
                    $_SESSION['wybrany_tryb'] = 'A';
                    $wszystko_OK = true;
                }
                break;
            case 'T':
                if ($tryb_pacy == "A")
                {
                    $wszystko_OK = false;
                    $_SESSION['e-trybpracy'] = "Nie masz możliwości zmiany na ten tryb pracy";
                }
                if ($tryb_pacy == "U") 
                {
                    $_SESSION['wybrany_tryb'] = 'U';
                    $wszystko_OK = true;
                }
                if ($tryb_pacy == "T") 
                {
                    $_SESSION['wybrany_tryb'] = 'T';
                    $wszystko_OK = true;
                }
                break;
        }

        
        
        if ($wszystko_OK==true)
        {
            unset($_SESSION['e-trybpracy']);
            header('Location: glowna.php');
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
                
                <br />
                <p style="font-weight: 700; font-size: 24px">Zmiana trybu pracy </p>
                <br /><br />
		
                <label><input type="radio" value="U" name="tryb_pacy" checked> (U) Użytkownik </label>
                <br /><br />    
                <label><input type="radio" value="A" name="tryb_pacy"> (A) Administrator </label>
                <br /><br /> 
                <label><input type="radio" value="T" name="tryb_pacy"> (T) Team Leader </label>
                        
                <br /><br /><br />
                
                <input type="submit" value="Zapisz" class="przycisk"/>
                <?php
                    if (isset($_SESSION['e-trybpracy']))
			         {
				        echo '<div class="error">'.$_SESSION['e-trybpracy'].'</div>';
				        unset($_SESSION['e-trybpracy']);
			         }
		          ?>

                
                
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