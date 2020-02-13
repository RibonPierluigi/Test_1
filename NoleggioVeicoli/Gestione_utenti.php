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
function oggetti_aggiorna($nome_file, $nome_campi, $chiave, $nuovo_oggetto)
{
	if(file_exists($nome_file))
	{
		$file=fopen($nome_file,"r");
		$tmp = fopen("tmp.csv","w");
		$riga=fgets($file);
		while(!feof($file))
		{
			$oggetto=oggetto_da_csv($nomi_campi,$riga);
			if($oggetto[$chiave] == $nuovo_oggetto[$chiave])
			{
				$riga = oggetto_a_csv($nome_campi,$nuovo_oggetto);
				fputs($tmp,$riga);
			}
			else
				fputs($tmp,$riga);
			$riga=fgets($file);
		}
		fclose($file);
		fclose($tmp);
		unlink($nome_file);
		rename("tmp.csv",$nome_file);
		return true;
	}
	return false;
}
function doubleCheck($nome_file, $valorechiavi, $chiavi, $pos)
{
	if(file_exists($nome_file))
	{
		$temp=array();
		for($i=0;$i<count($valorechiavi);$i++)
		{
			$temp[$chiavi[$i]]=$valorechiavi[$i];
		}
		$arr=array();
		$file=fopen($nome_file,"r");
		$arr=fgetcsv($file);
		$tem=array();
		$counter=0;
		while(!feof($file))
		{
			for($i=0;$i<count($pos);$i++)
				$tem[$chiavi[$i]]=$arr[$pos[$i]];
			$unlock=true;
			for($i=0;$i<count($valorechiavi);$i++)
			{
				if($tem[$chiavi[$i]]!=$temp[$chiavi[$i]])
					$unlock=false;
			}
				if($unlock)
					return array($counter,$arr);
			//ritorno posizione, full array per posizione
		$arr=fgetcsv($file);
		$counter++;
		}
		return array();
	}
	else
		return array();
}
function oggetti_cerca($nome_file,$nomi_campi,$chiave,$valore)
{
	$oggetti=array();
	if(file_exists($nome_file))
	{
		$file=fopen($nome_file,"r");
		$riga=fgets($file);
		while(!feof($file))
		{
			$oggetto = oggetto_da_csv($nomi_campi,$iga);
			if($oggetto[$chiave]==$valore)
			{
				array_push($oggetti,$oggetto);
			}
			$riga=fgets($file);
		}
	}
}
function oggetti_rimuovi($nome_file,$nome_campi,$chiave,$valore)
{
	if(file_exists($nome_file==true))
	{
		$file=fopen($nome_file,"r");
		$tmp = fopen($nome_file."tmp","w");
		$riga=fgets($file);
		while(!feof($file))
		{
			$oggetto = oggetto_da_csv($nome_campi,$riga);
			if($oggetto[$chiave] != $valore)
			{
				fputs($tmp,$riga);
			}
			$riga=fgets($file);
		}
		fclose($file);
		fclose($tmp);
		unlink($nome_file);
		rename($nome_file."tmp",$nome_file);
	}
	return false;
}
function modifica_csv($nome_file)
{
	if(file_exists("temp.txt"))
	{
		if(file_exists($nome_file))
		{
			$f=fopen("temp.txt","r");
			$max=fgets($f);
			$e=fopen($nome_file,"r+");
			for($i=0;$i<$max;$i++)
			{
				$oggetto=fgetcsv($e);
				print_r($oggetto);
			}
			fputcsv($e,array("ABABBB12C34D567E","Mario","Reginald","20/08/1980","banaa@gmail.com","M","43543545"));
			fclose($f);
			fclose($e);
		}
		return false;
	}
	return false;
}
?>