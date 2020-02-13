<?php
include_once("Gestione_utenti.php");
modifica_csv("utenti.csv");
?>
<html>
<body>
<form action="reinserisci_utente.php" method="POST">
<input type="text" name="cod_fisc" placeholder="AD23423ASDA">
<input type="text" name="password" placeholder="******" autocomplete="off">
<input type="hidden" name="secret" value="true">
<input type="submit" value="Invia">
</form>
</body>
</html>