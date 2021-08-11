<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}

try 
{
    require_once "database.php";
    $uzytkownik = ltrim(rtrim($_SESSION['uzytkownik']));
    $NumerPrac = (int)$uzytkownik;
    $sql = "SET NOCOUNT ON; EXEC dbo.TA_WeWy_tydzien ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $NumerPrac);
    $stmt->execute();
    $rekordy = $stmt->fetchAll(PDO::FETCH_BOTH);
    

}
catch(Exception $e)
{
	echo '<span style="color:red;">Błąd połączenia z bazą danych!</span>';
    //echo '<br />Informacja developerska: '.$e;
}

/*
function dodajczas($time1, $time2) 
{
    $times = array($time1, $time2);
    $seconds = 0;
    foreach ($times as $time)
    {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
    }
    $hours = floor($seconds/3600);
    $seconds -= $hours*3600;
    $minutes  = floor($seconds/60);
    $seconds -= $minutes*60;
    if($seconds < 9)
    {
      $seconds = "0".$seconds;
    }
    if($minutes < 9)
    {
      $minutes = "0".$minutes;
    }
    if($hours < 9)
    {
      $hours = "0".$hours;
    }
      return "{$hours}:{$minutes}:{$seconds}";
    }

*/



?>
<!DOCTYPE html>
<html lang="pl">

	<head>
	
		<meta charset="utf-8">
		<title>Kiosk danych</title>
		<meta name="author" content="Ryszard Babula">
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
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
        <h3>Czas pracy - bieżący tydzień</h3>
        <table>
            <thead>
				<tr><th>Lp</th><th>Numer ID</th><th>Numer karty</th><th>Wejście</th><th>Wyjście</th><th>Czas pracy</th></tr>
			</thead>
			<tbody>
				<?php
                    $lp = 1;
                    //$czaspracy = strtotime('H:i:s', 0);       
                    foreach($rekordy as $row)
                    {
                        if ($row['Numer ID'] == $uzytkownik)
                        {
                            $wejscie = $row['Wejscie'];
                            $dzien = substr($wejscie,0,10);
                            $godzina = substr($wejscie,11,5);
                            $wejscie = $dzien."    ".$godzina;
                            
                            $wyjscie = $row['Wyjscie'];
                            $dzien = substr($wyjscie,0,10);
                            $godzina = substr($wyjscie,11,5);
                            $wyjscie = $dzien."    ".$godzina;

                            echo "<tr><td>$lp</td><td>{$row['Numer ID']}</td><td>{$row['Karta']}</td><td>$wejscie</td><td>$wyjscie</td><td>{$row['Czas Pracy']}</td></tr>";
                            $lp++;
                            //$czaspracyrazem = dodajczas($row['Czas Pracy'], $czaspracy);
                        }    
                    }
                //echo "<tr><td></td><td></td><td></td><td></td><td>Razem: </td><td>$czaspracyrazem</td></tr>";
				?>
			</tbody>
            </table>
            
        </div>
        <div class="container"></div>
        <div style="clear:both;"></div>
        <div class="stopka">
            <a href="http://www.hitachi-automotive.co.jp/en/" target="_blank">Hitachi Atomotive</a>
            <a href="https://cbigroup.sharepoint.com" target="_blank">Sharepoint CBI</a>
         </div>
        
        </div>
        
	</body>
	
</html>