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
$cfErr="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(empty($_POST["codiceFiscale"]))
		$cfErr="Campo obbligatorio";
	elseif(preg_match("/^[a-zA-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$/",$_POST["codiceFiscale"]))
	{
		$cfErr="Caratteri non consentiti";
	}
}
?>
<?php
include_once("Gestione_utenti.php");
if($_SERVER["REQUEST_METHOD"]=="POST" && $cfErr!="Campo obbligatorio")
{
	oggetti_aggiungi("Utenti.csv",array("codiceFiscale","nome","cognome","gg","mm","aaaa","mail","password"),$_POST);
	die();
}
?>
<h1>
Inserisci utenti
</h1>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
Codice Fiscale<span class="error">*<?php echo $cfErr;?></span><br>
<input type="text" name="codiceFiscale" autocomplete="on" placeholder="AAABBB12C34D567E"><br><br>
Cognome<span class="error">*</span><br>
<input type="text" name="cognome" placeholder="De Angelis" autocomplete="on"><br><br>
Nome<span class="error">*</span><br>
<input type="text" name="nome" placeholder="Mario" autocomplete="on"><br><br>
Data di nascita<span class="error">*</span><br>
<input type="text" name="gg" placeholder="gg" maxlength="2" size="2" autocomplete="on">/
<input type="text" name="mm" placeholder="mm" maxlength="2" size="2" autocomplete="on">/
<input type="text" name="aaaa" placeholder="aaaa" maxlength="4" size="4" autocomplete="on"><br><br>
Email<span class="error">*</span><br>
<input type="text" name="mail" placeholder="example@example.it"><br><br>
Password<span class="error">*</span><br>
<input type="text" name="password" placeholder="********" autocomplete="off" maxlength="8"><br>
<br>
<span class="error" style="fontsize="10px;">Campi Obbligatori</span><br><br>
<input type="submit" value="Conferma">&nbsp&nbsp&nbsp
<input type="reset" value="Annulla">
</form>
</body>
</html>