<?php
////////////////////////////////////////
////// SCRIPT PHP DECODEUR ORANGE //////
//////        VERSION 1.44        //////
//////       CREE PAR VIRGIE      //////
////////////////////////////////////////

$IP="VOTRE_IP_PUBLIQUE"; // <-- INDIQUEZ VOTRE ADRESSE IP PUBLIQUE
$PORT="PORT_EXTERNE"; // <-- INDIQUEZ LE PORT EXTERNE OUVERT SUR VOTRE LIVEBOX

///////////////////////////////////
// EVITER DE MODIFIER CI DESSOUS //
///////////////////////////////////

$M1 = '/allume|allumé|allumer|lance|àctive|démarre|éteins|éteint|éteindre|arrête/i'; // Allumer/Eteindre
$M2 = '/son|volume/i'; // Fonction son
$M3 = '/monte|augmente/i'; // Augmente le volume
$M4 = '/baisse|diminue/i'; // Baisser le son
$M5 = '/règle|met/i'; // Règle le son à un certain niveau
$M6 = '/coupe|couper|coupé|remet|remé|remettre|active|réactive/i'; // Couper le son
$M7 = '/mets|met|chaîne|mais|change||/i'; // Changer de chaine
$M8 = '/suivante/i'; // Chaine suivante
$M9 = '/précédente/i'; // Chaine précédente
$M10 = '/ok|valide|confirme/i'; // ok
$M11 = '/annule|retour|back/i'; // Retour
$M12 = '/pause|lecture|play/i'; // Chaine précédente
$M13 = '/avance rapide/i'; // Avance rapide
$M14 = '/retour rapide/i'; // Retour rapide

$com = $_GET['com'];
if (!$com) { exit; }

if (file_exists("famille.php")) { include ("./famille.php"); }
if (file_exists("cine-series-max.php")) { include ("./cine-series-max.php"); }
elseif (file_exists("cine-series.php")) { include ("./cine-series.php"); }
if (file_exists("bein-sports-max.php")) { include ("./bein-sports-max.php"); }
elseif (file_exists("bein-sports.php")) { include ("./bein-sports.php"); }
if (file_exists("Pickle-TV.php")) { include ("./Pickle-TV.php"); }
if (file_exists("melody.php")) { include ("./melody.php"); }
if (file_exists("musique-classique.php")) { include ("./musique-classique.php"); }
if (file_exists("canal.php")) { include ("./canal.php"); }
if (file_exists("canal-famille.php")) { include ("./canal-famille.php"); }
if (file_exists("adulte.php")) { include ("./adulte.php"); }
if (file_exists("gay.php")) { include ("./gay.php"); }
if (file_exists("generalistes.php")) { include ("./generalistes.php"); }

if ((!$Pid) AND (!$nb))
{
if (stristr($com, 'TF 1 série')) { $Pid="1404"; }
elseif (stristr($com, 'tf 1')) { $Pid="192"; }
elseif (stristr($com, 'france 2')) { $Pid="4"; }
elseif (stristr($com, 'france 3')) { $Pid="80"; }
elseif (stristr($com, 'canal +')) { $Pid="34"; }
elseif (stristr($com, 'france 5')) { $Pid="47"; }
elseif (stristr($com, 'm 6')) { $Pid="118"; }
elseif (stristr($com, 'arte')) { $Pid="111"; }
elseif (stristr($com, 'c 8')) { $Pid="445"; }
elseif (stristr($com, 'w 9')) { $Pid="119"; }
elseif (stristr($com, 'tmc')) { $Pid="195"; }
elseif (stristr($com, 'nt 1')) { $Pid="446"; }
elseif (stristr($com, 'TFX')) { $Pid="446"; }
elseif (stristr($com, 'NRJ 12')) { $Pid="444"; }
elseif (stristr($com, 'lcp')) { $Pid="234"; }
elseif (stristr($com, 'france 4')) { $Pid="78"; }
elseif (stristr($com, 'bfm')) { $Pid="481"; }
elseif (stristr($com, 'cnews')) { $Pid="226"; }
elseif (stristr($com, 'cstar')) { $Pid="458"; }
elseif (stristr($com, 'gulli')) { $Pid="482"; }
elseif (stristr($com, 'france Ô')) { $Pid="160"; }
elseif (stristr($com, 'hd 1')) { $Pid="1404"; }
elseif (stristr($com, 'equipe')) { $Pid="1401"; }
elseif (stristr($com, '6 ter')) { $Pid="1403"; }
elseif (stristr($com, 'rmc story')) { $Pid="1402"; }
elseif (stristr($com, 'rmc')) { $Pid="1400"; }
elseif (stristr($com, 'cherie')) { $Pid="1399"; }
elseif (stristr($com, 'lci')) { $Pid="112"; }
elseif (stristr($com, 'france info')) { $Pid="2111"; }
elseif (stristr($com, ' une')) { $nb="1"; }
}

if ((!$Pid) AND (!$nb)) { $nb = preg_replace('~\D~', '', $com); }


////////////////////////////////
// NE PAS MODIFIER CI DESSOUS //
////////////////////////////////

// FONCTION ALLUMER // ETEINDRE
if ((preg_match("$M1", "'.$com.'") == TRUE))
{
$OnOff = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=116&mode=0");
echo "$OnOff";
sleep(4);
$OffMenu = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=139&mode=0");
echo "$OffMenu"; exit;
}

// PLAY / PAUSE
elseif ((preg_match("$M12", "'.$com.'") == TRUE))
	{
	$PlayPause = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=164&mode=0");
	echo "$PlayPause"; exit;
	}
// Avance rapide
elseif ((preg_match("$M13", "'.$com.'") == TRUE))
	{
	$Avancerapide = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=159&mode=0");
	echo "$Avancerapide"; exit;
	}

// Retour rapide
elseif ((preg_match("$M14", "'.$com.'") == TRUE))
	{
	$Retourrapide = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=168&mode=0");
	echo "$Retourrapide"; exit;
	}
	
// FONCTION SON
elseif ((preg_match("$M2", "'.$com.'") == TRUE))
{
if (!$nb) { $nb = 1; }
	// AUGMENTE
	if ((preg_match("$M3", "'.$com.'") == TRUE))
	{
		$a = 0;
		while ($a < $nb)
		{
		$volume = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=115&mode=0");
		echo "$volume";
		$a++;
		}
		exit;
	}

  // DIMINUE
	elseif ((preg_match("$M4", "'.$com.'") == TRUE))
	{
		$a = 0;
		while ($a < $nb)
		{
		$volume = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=114&mode=0");
		echo "$volume";
		$a++;
		}
		exit;
	}
  // COUPER / REMETTRE
	elseif ((preg_match("$M6", "'.$com.'") == TRUE))
	{
	$MutUnmut = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=113&mode=0");
	echo "$MutUnmut"; exit;
	}
  // REGLE A / MET 
	elseif ((preg_match("$M5", "'.$com.'") == TRUE))
	{
		if (stristr($com, ' %')) { $nb = ($nb*16)/100; $nb = round($nb); }
		//baisser à 0
		$a = 0;	while ($a < 16) { $volume = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=114&mode=0"); echo "$volume"; $a++; }
		//remettre au niveau demandé
		$a = 0;	while ($a < $nb) { $volume = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=115&mode=0"); echo "$volume"; $a++; }		
		exit;
	}	
}

// FONCTION OK
elseif ((preg_match("$M10", "'.$com.'") == TRUE))
{
$Ok = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=352&mode=0");
echo "$Ok"; exit;
}

// FONCTION RETOUR
elseif ((preg_match("$M11", "'.$com.'") == TRUE))
{
$Retour = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=158&mode=0");
echo "$Retour"; exit;
}

// FONCTION CHAINE SUIVANTE
elseif ((preg_match("$M8", "'.$com.'") == TRUE))
{
$ChaineSuivante = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=402&mode=0");
echo "$ChaineSuivante"; exit;
}

// FONCTION CHAINE PRECEDENTE
elseif ((preg_match("$M9", "'.$com.'") == TRUE))
{
$ChainePrecedente = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=403&mode=0");
echo "$ChainePrecedente"; exit;
}

// FONCTION CHANGEMENT DE CHAINE
elseif (is_numeric($Pid))
{
$key = str_pad("$Pid", 10, "*", STR_PAD_LEFT );
$SelectChaine = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=09&epg_id=$key&uui=1");
echo "$SelectChaine"; exit;
}
elseif ((preg_match("$M7", "'.$com.'") == TRUE))
{
	$a = 0;
	if (!is_numeric($nb)) { $nb=0; }
	$b = strlen($nb);
	while ($a < $b)
	{
	$key = 512+$nb[$a];
	$chaine = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=$key&mode=0");
	echo "$chaine";
	$a++;
	}
	exit;
}
else
{
$changechaine = file_get_contents("http://$IP:$PORT/remoteControl/cmd?operation=01&key=513&mode=0");
echo "$changechaine"; exit;
}
?>

