<html>
<head>
<title></title>
<link rel="stylesheet" href="css/stats.css" type="text/css">
</head>
<body>
<div class="header">
  <a href="http://www.womoz.org/wiki/doku.php" style="text-decoration:none"><img src="images/womoz-logo2.jpg" style="border:none"/></a>
</div>

<?php
	function VerifierAdresseMail($adresse) 
	{ 
	   $Syntaxe='#^[+\w.-_]+@[+\w.-_]+\.[a-zA-Z]{2,6}$#'; 
	   if(preg_match($Syntaxe,$adresse)) 
		  return true; 
	   else 
		 return false; 
	}

	// On commence par r�cup�rer le champ
	if(isset($_POST['email'])){
		$email=$_POST['email'];
	}
	else{$email="";}

	// On v�rifie si les champs sont vides
	if(empty($email))
		{
		echo '<div class="memeCats"
			    <p align="center">
				  <img src="images/oops.jpg" /><br /><br />
				  <span class="typo3"><font color="red">oOps!!,The Field <b>M@il</b> is Empty !</font></span><br /><br />
				  <a href="http://vs28.vs.toile-libre.net/index.html" class="return">Return</a>
			    </p>
			 </div>';
		}
	elseif(!VerifierAdresseMail($email)){
		echo '<div class="memeCats">
		         <p align="center">
				   <img src="images/cheez.jpg" /><br /><br />
				   <span class="typo3"><font color="red">Your Doin iT WronG !</font></span><br /><br />
				  <a href="http://vs28.vs.toile-libre.net/index.html" class="return">Return</a>
				 </p>
		      </div>';
	}
	// Le champ n'est pas vide, et le format du mail est valide -> on peut enregistrer dans la table
	else {
		// connexion � la base
		$db = mysql_connect('localhost', '*********', '**********') or die('Erreur de connexion '.mysql_error());
		// s�lection de la base  
		mysql_select_db('Sondage_Fosdem',$db)  or die('Erreur de selection '.mysql_error());
    
		// on �crit la requ�te sql
		$sql = "INSERT INTO MAILS(email) VALUES('$email')";
    
		 // on ins�re les informations du formulaire dans la table
		 mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());

		 // on affiche le r�sultat pour le visiteur
		 echo '<div class="memeCats">
		         <p align="center">
				    <img src="images/secret.jpg" /><br /><br/>
					<span class="typo3">We GoT You !!</span>
			     </p>
			</div>';

		mysql_close();  // on ferme la connexion
	 }
?> </span>
</body>
</html>
