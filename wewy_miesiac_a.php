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
    $sql = "SET NOCOUNT ON; EXEC dbo.TA_ListaPrac_WeWy_miesiac";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rekordy = $stmt->fetchAll(PDO::FETCH_BOTH);
    

}
catch(Exception $e)
{
	echo '<span style="color:red;">Błąd połączenia z bazą danych!</span>';
    //echo '<br />Informacja developerska: '.$e;
}


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
        <form method="post" action="wewy_miesiac_a1.php">
        <h3>Czas pracy - bieżący miesiac</h3>
            
        <h4>Wybór pracownika</h4>
            <label> Pracownik:  </label>
            <select name="pracownik">

				<?php
                    $lp = 1;
                    foreach($rekordy as $row)
                    {
                        $nazwisko = $row['Nazwisko'];
                        $imie = $row['Imie'];
                        $_SESSION['numerid'] = $row['Numer ID'];
                        $wybor = $nazwisko." ".$imie." ".$numerid;
                        echo'<option value="'.$_SESSION['numerid'].'">'.$wybor.'</option>';
                    }
				?>
            </select>
            <input type="submit" value="Pokaż" class="przycisk">
            </form>
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