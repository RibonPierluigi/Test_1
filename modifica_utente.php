<html>
<head>
</head>
<body>
<h6>Inserisci il codice fiscale dell'utente da modificare</h6>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
include_once("Gestione_utenti.php");
$b="";
$oggetto = array();
$oggetto=oggetti_carica("Utenti.csv", array("codiceFiscale","nome","cognome","età","password"));
$temp = array();
for($i=0;$i<count($oggetto);$i++)
{
	$temp=$oggetto[$i];
	if($temp["codiceFiscale"]==$_POST["cod_fisc"])
		$b="Bho";
}
echo $b;
die();
}
?>
<form action="modifica_utente.php" method="POST">
<input type="text" name="cod_fisc" placeholder="AD23423ASDA">
<input type="submit" value="Invia">
</form>
</body>
</html>