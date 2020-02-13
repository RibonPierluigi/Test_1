<?php
$cfErr=$cf="";
if($_SERVER["REQUEST_METHOD"]=="POST")
	{
	if(empty($_POST["cod_fisc"]))
		$cfErr="Campo obbligatorio";
	elseif(preg_match("/^[a-zA-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$/",$_POST["cod_fisc"])==false)
	{
		$cfErr="Caratteri non consentiti";
	}
	else
		$cf = $_POST["cod_fisc"];
	}
?>
<html>
<body>
<h1>
Rimuovi utente
</h1>
<span style="color:red"> <?php echo"*".$cfErr;?></span>
<form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
<input type="text" name="cod_fisc" placeholder="AD23423ASDA">
<input type="text" name="password" placeholder="******" autocomplete="off">
<input type="hidden" name="secret" value="true">
<input type="submit" value="Elimina">
<input type="reset" value="Annulla">
</form>
</body>
</html>