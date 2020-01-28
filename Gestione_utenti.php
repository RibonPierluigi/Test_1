<?php
function oggetto_to_csv($nomi_campi, $oggetto) {
	$riga="";
	$num_campi = count($nomi_campi);
	for($i = 0; $i < $num_campi; $i++) {
		$riga .= $oggetto[$nomi_campi[$i]];
        $riga .= ",";
	}
	return $riga."\n";
}
function oggetto_da_csv($nomi_campi, $riga) {
	$riga = rtrim($riga);
	$els = explode(",", $riga);
	$oggetto = array();
	for($i = 0; $i < count($nomi_campi); $i++) {
		$oggetto[$nomi_campi[$i]] = $els[$i];
	}
	return $oggetto;
}

function oggetti_aggiungi($nome_file, $nomi_campi, $oggetto) {
	$file = fopen($nome_file, "a");
	$riga = oggetto_to_csv($nomi_campi, $oggetto);
	fputs($file, $riga);		
	fclose($file);
}

function oggetti_carica($nome_file, $nomi_campi) {
	$oggetti = array();
    
	if(file_exists($nome_file)) {
		$file = fopen($nome_file, "r");

		$riga = fgets($file);

		while(!feof($file)) {
			$oggetto = oggetto_da_csv($nomi_campi, $riga);
			array_push($oggetti, $oggetto);
			$riga = fgets($file);
		}

		fclose($file);
	}
	return $oggetti;
}
?>