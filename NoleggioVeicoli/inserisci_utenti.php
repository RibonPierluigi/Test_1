<html>
<head>
<style>
.error
{
	color:red;
}
</style>
</head>
<body>
<?php
include_once("gestioneTempo.php");
$cfErr=$cogErr=$nomErr=$dataErr=$mailErr="";
$cf=$cog=$nom=$data=$mail="";
$utente=array("codiceFiscale"=>"","cognome"=>"","nome"=>"","sesso"=>"","data"=>"","email"=>"","sesso"=>"");
$errore=true;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(empty($_POST["codiceFiscale"]))
		$cfErr="Campo obbligatorio";
	elseif(preg_match("/^[a-zA-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$/",$_POST["codiceFiscale"])==false)
	{
		$cfErr="Caratteri non consentiti";
	}
	else
		$cf = $_POST["codiceFiscale"];
	
	if(empty($_POST["cognome"]))
		$cogErr = "Campo obbligatorio";
	elseif(preg_match("/^[a-z A-Z]*$/",$_POST["cognome"])==false)
		$cogErr = "Caratteri non consentiti";
	else
		$cog=$_POST["cognome"];
	
	if(empty($_POST["nome"]))
		$nomErr = "Campo obbligatorio";
	elseif(preg_match("/^[a-z A-Z]*$/",$_POST["nome"])==false)
		$nomErr = "Caratteri non consentiti";
	else
		$nom=$_POST["nome"];
	
	if(empty($_POST["gg"])== true || empty($_POST["mm"])== true || empty($_POST["aaaa"])== true)
		$dataErr = "Campo obbligatorio";
	elseif($_POST["gg"]<1 || $_POST["gg"]>31 || $_POST["mm"]<1 || $_POST["mm"]>12 || $_POST["aaaa"]<1920 || $_POST["aaaa"]>2002)
		$dataErr = "Data non valida";
	elseif(controlloTemporale($_POST["gg"],$_POST["mm"],$_POST["aaaa"]))
		$data=$_POST["gg"]."/".$_POST["mm"]."/".$_POST["aaaa"];
	else
		$dataErr = "Data non valida";	
	
	if(empty($_POST["mail"]))
		$mailErr="Campo obbligatorio";
	elseif(filter_var($_POST["mail"],FILTER_VALIDATE_EMAIL)==false)
		$mailErr="Mail non valida";
	else
		$mail=$_POST["mail"];
if($cfErr=="" && $cogErr=="" && $nomErr=="" && $dataErr=="" && $mailErr=="")
	$errore=false;
$utente["codiceFiscale"]=$cf;
$utente["cognome"]=$cog;
$utente["nome"]=$nom;
$utente["data"]=$_POST["sesso"];
$utente["data"]=$data;
$utente["email"]=$mail;
$utente["sesso"]=$_POST["sesso"];
}
include_once("Gestione_utenti.php");
if($_SERVER["REQUEST_METHOD"]=="POST" && $errore==false)
{
	$f=fopen("utenti.csv","a");
	fputcsv($f,array($utente["codiceFiscale"],$utente["cognome"],$utente["nome"],$utente["data"],$utente["email"],$utente["sesso"],$_POST["password"]),",");
	fclose($f);
	die();
	//oggetti_aggiungi("Utenti.csv",array("codiceFiscale","nome","cognome","gg","mm","aaaa","mail","password"),$_POST);
}
?>
<h1>
Inserisci utenti
</h1>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
Codice Fiscale<span class="error">*<?php echo $cogErr;?></span><br>
<input type="text" name="codiceFiscale" autocomplete="on" placeholder="AAABBB12C34D567E" maxlength="16" value="<?php echo $utente["codiceFiscale"];?>"><br><br>
Cognome<span class="error">*<?php echo $cfErr;?></span><br>
<input type="text" name="cognome" placeholder="De Angelis" autocomplete="on" value="<?php echo $utente['cognome']; ?>"><br><br>
Nome<span class="error">*<?php echo $nomErr;?></span><br>
<input type="text" name="nome" placeholder="Mario" autocomplete="on" value="<?php echo $utente["nome"];?>"><br><br>
<!--<input type="date name=data" max="2002-01-01" min="1920-01-01">-->
Sesso<br>
<select name="sesso" >
<option value="M">M</option>
<option value="F">F</option>
<option value="A">Altro</option>
<option value="R">Robot</option>
</select><br><br>
Data di nascita<span class="error">*<?php echo $dataErr;?></span><br>
<input type="text" name="gg" placeholder="gg" maxlength="2" size="2" autocomplete="on">/
<input type="text" name="mm" placeholder="mm" maxlength="2" size="2" autocomplete="on">/
<input type="text" name="aaaa" placeholder="aaaa" maxlength="4" size="4" autocomplete="on"><br><br>
Email<span class="error">*<?php echo $mailErr;?></span><br>
<input type="text" name="mail" placeholder="example@example.it" value="<?php echo $utente["email"];?>"><br><br>
Password<span class="error">*</span><br>
<input type="text" name="password" placeholder="********" autocomplete="off" maxlength="8"><br>
<br>
<span class="error" style="fontsize="10px;">Campi Obbligatori</span><br><br>
<input type="submit" value="Conferma">&nbsp&nbsp&nbsp
<input type="reset" value="Annulla">
</form>
</body>
</html>