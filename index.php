<?php

session_start();

if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
    header('Location: glowna.php');
    exit();
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
            //echo '<span style="font-size: 16px;">Użytkownik:</span> <br />';
            
        ?>
    </div>

        
    <div id="logo">
         <img src="img/HitachiLogo.jpg">
    </div>
   
    <div style="clear:both;"></div>
        
     <hr>    
    <div class="glowneokno">
	<div id="container">
		<form action="zaloguj.php" method="post">
			
			<input type="text" name="uzytkownik" placeholder="użytkownik" onfocus="this.placeholder=''" onblur="this.placeholder='użytkownik'" >
			
			<input type="password" name="haslo" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" >
			
			<input type="submit" value="Zaloguj się">
			
		</form>
	
        <?php
        
            if(isset($_SESSION['blad']))
            echo $_SESSION['blad'];
        ?>
        
        <div style="clear:both;"></div>
        </div> 
        </div>
        <div class="stopka">
            <a href="http://www.hitachi-automotive.co.jp/en/" target="_blank">Hitachi Atomotive</a>
            <a href="https://cbigroup.sharepoint.com" target="_blank">Sharepoint CBI</a>
         </div>
        
        </div>
        
	</body>
	
</html>