<table border="1" width="100%">
<tr>
	<th>Codice Fiscale</th>
	<th>Cognome</th>
	<th>Nome</th>
	<th>Data</th>
	<th>Email</th>
	<th>Sesso</th>
</tr>
<?php
require_once("Gestione_utenti.php");
$utenti=oggetti_carica("utenti.csv",["codiceFiscale","cognome","nome","data","mail","sesso"]);
foreach($utenti as $utente)
{
	echo"<tr>";
	echo"<td>".$utente["codiceFiscale"]."</td>"."<td>".$utente["cognome"]."</td>"."<td>".$utente["nome"]."</td>"."<td>".$utente["data"]."</td>"."<td>".$utente["mail"]."</td>"."<td>".$utente["sesso"]."</td>";
	echo"</tr>";
}
?>
</table>