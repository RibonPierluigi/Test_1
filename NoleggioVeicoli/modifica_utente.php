<html>
<head>
</head>
<body>
<h6>Inserisci il codice fiscale dell'utente e password da modificare</h6>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["secret"]==true)
{
include_once("Gestione_utenti.php");
$unlock=false;
$a=(doubleCheck("utenti.csv",array($_POST["cod_fisc"],$_POST["password"]),array("codiceFiscale","password"),array(0,6)));
print_r($a);
if(count($a)==0)
{	echo "Utente o password errata";
	die();
}
else
{
	$f=fopen("temp.txt","w");
	fputs($f,$a[0]);
	fclose($f);
	header("Location:reinserisci_utente.php");
}
}
//Se button = true; allora attivare il check e procedura di input seconda con 
?>
<form action="modifica_utente.php" method="POST">
<input type="text" name="cod_fisc" placeholder="AD23423ASDA">
<input type="text" name="password" placeholder="******" autocomplete="off">
<input type="hidden" name="secret" value="true">
<input type="submit" value="Invia">
</form>
</body>
</html>