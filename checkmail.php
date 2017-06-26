<?php
header("Content-Type: application/json");
error_reporting(0);
@ini_set('display_errors', 0);


$tab_billet = array();
$billet_trajets = array();
$news = 0;


$boiteMail = 'ssl0.ovh.net';
$port = 143;
$login = 'billet@eximvoyages.com';
$motDePasse = 'amideus16';

$mbox = imap_open('{' . $boiteMail . ':' . $port . '/novalidate-cert}', $login, $motDePasse);
if (FALSE === $mbox) {
    $info = FALSE;
    $err = 'La connexion a échoué. Vérifiez vos paramètres!';
    echo $err;
} else {
    $emails = imap_search($mbox, 'UNSEEN');
    //imap_close($mbox);
}
$output = " ";
$tabemail = array();
$i = 0;
if(isset($emails) && $emails !=null)
{
    foreach ($emails as $email_number) {
        /* get infrmation specific to this email */
        $overview = imap_fetch_overview($mbox, $email_number, 0);
        $message = imap_fetchbody($mbox, $email_number, 2);
        $textname = 'mmymail' . $email_number . '.txt';
        imap_savebody($mbox, $textname, $email_number);
        $haha = imap_body($mbox, $email_number, ST_UID);
        $tabemail[$i] = $textname;
        $i++;
    }
}
else{
    $news = 0;
}

foreach ($tabemail as $key => $value) {
    $billet = array();
    $trajet = array();
    $trajet_tab = array();
    $file1 = $value;
    $lines = file($file1);
    $maligne = 0;
    $samalines = array();
    $maligne = 0;
    $a = 0;
    $i = 0;
    $sep_count = 0;
    //echo count($lines);
    while ($a <= count($lines)) {
        $line = $lines[$a];
        //$line = str_replace(' ', '', $line);
        $line = trim($line);
        $samalines[$i] = $line;
        $str = substr($line, -1);
        if ($str == "=") {
            $samalines[$i] = preg_replace("#=#", $lines[$a + 1], $samalines[$i]);
            $a++;
        }
        $a++;
        $i++;
        if (preg_match("#^-------------------------#", $line)) {
            $sep_count++;
            if($sep_count == 2)
                break;
        }

    }
    foreach ($samalines as $line_num => $line) {
        $maligne++;
        //trim($line, " ");
        $words = preg_split('/[\s]+/', $line, -1, PREG_SPLIT_NO_EMPTY);
        // $words = explode(" ", $line);
        //print_r($words);
        if (preg_match("#^BILLET#", $line)) {
            $maligne = 0;
            $myline = $line_num;
            //echo "Debut billet <br />";
        }
        if (preg_match("#^TARIF#", $line)) {
            $tarif = $line_num;
            //echo "Debut Tarif <br />";
        }
        if (preg_match("#^TOTAL#", $line)) {
            $total_line = $line_num;
            //echo "Debut Total <br />";
        }
        if (preg_match("#^TAUX#", $line)) {
            $taux_line = $line_num;
            echo $line."<br />";
            echo "Debut Taux <br />";
        }
        if (preg_match("#^REFERENCE#", $line)) {
            $ref_line = $line_num;
            //echo "Debut Ref <br />";
        }
//		echo "<br>Original $line_num ligne: $maligne <br>";
//		print_r($words);

    }

//	echo "Tarifffff = :".$samalines[$tarif];
    $tarifaerien = preg_split('/[\s]+/', $samalines[$tarif], -1, PREG_SPLIT_NO_EMPTY);

    $montantht = $tarifaerien[4];
    //echo '<br>prix ht: ' . $montantht;
    $total = preg_split('/[\s]+/', $samalines[$total_line], -1, PREG_SPLIT_NO_EMPTY);
    $montanttc = $total[3];
    //echo '<br>prix ttc: ' . $montanttc;
    $datewords = preg_split('/[\s]+/', $samalines[$myline + 3], -1, PREG_SPLIT_NO_EMPTY);
    //echo '<br>date: ' . $datewords[3] . ' ' . $datewords[4] . ' ' . $datewords[5];
    $date_billet = $datewords[3] . ' ' . $datewords[4] . ' ' . $datewords[5];
    $agentwords = preg_split('/[\s]+/', $samalines[$myline + 4], -1, PREG_SPLIT_NO_EMPTY);
    //echo '<br>Agent: ' . $agentwords[5];
    $clientwords = preg_split('/[\s]+/', $samalines[$myline + 5], -1, PREG_SPLIT_NO_EMPTY);
    $noms = preg_split('/[\/]+/', $clientwords[1]);
    $nom = $noms[0];
    $prenom = $noms[1];
    //echo '<br>Client: '. $prenom . ' ' . $nom . ' ';
    $iatawords = preg_split('/[\s]+/', $samalines[$myline + 7], -1, PREG_SPLIT_NO_EMPTY);
    //echo '<br>Code IATA: ' . $iatawords[2] . ' ' . $iatawords[3];
    $myCodeIata = $iatawords[2] . ' ' . $iatawords[3];
    $compemewords = preg_split('/[\s]+/', $samalines[$myline + 11], -1, PREG_SPLIT_NO_EMPTY);
    //echo '<br>Compagnie emetrice ' . $compemewords[3] . ' ' . $compemewords[4];
    $myNomCompanie = $compemewords[3] . ' ' . $compemewords[4];
    $billetwords = preg_split('/[\s]+/', $samalines[$myline + 11], -1, PREG_SPLIT_NO_EMPTY);
    //echo '<br>Numero Billet ' . $billetwords[5] . ' ' . $billetwords[6];
    $myNumBillet = $billetwords[5] . ' ' . $billetwords[6];
    $dossierwords = preg_split('/[\s]+/', $samalines[$myline + 12], -1, PREG_SPLIT_NO_EMPTY);
    //echo '<br>Reference dossier: Amadeus: ' . $dossierwords[5] . ' AIRLINE ' . $dossierwords[7];
    $myrefDossier = $dossierwords[5] . ' AIRLINE ' . $dossierwords[7];
//    echo "Nom passager : ".$nom."<br />";
//    echo "prenom passager : ".$prenom."<br />";
//    echo "Civilité passager : ".$clientwords[2]."<br />";
//    echo "Code iata : ".$myCodeIata."<br />";
//    echo "Nom Compagnie : ".$myNomCompanie."<br />";
//    echo "Numero Billet : ".$myNumBillet."<br />";
//    echo "Montant htt : ".$montantht."<br />";
//    echo "Montant ttc : ".$montanttc."<br />";
//    echo "Refdossier : ".$myrefDossier."<br />";
    $news++;
    $billet['nom_psg'] = $nom;
    $billet['prenom_psg'] = $prenom;
    $billet['civilite_psg'] = isset($clientwords[2])?$clientwords[2]:'';
    $billet['code_iata'] = $myCodeIata;
    $billet['nom_comp'] = $myNomCompanie;
    $billet['numero_billet'] = $myNumBillet;
    $billet['date_billet'] = $date_billet;
    $billet['prix_htt'] = $montantht;
    $billet['prix_ttc'] = $montanttc;
    $billet['ref_dossier'] = $myrefDossier;
    array_push($tab_billet, $billet);

    $departwords1 = preg_split('/[\s]+/', $samalines[$ref_line + 4], -1, PREG_SPLIT_NO_EMPTY);
    //($departwords1);
    $departwords2 = preg_split('/[\s]+/', $samalines[$ref_line + 5], -1, PREG_SPLIT_NO_EMPTY);
    //print_r($departwords2);
    $departwords3 = preg_split('/[\s]+/', $samalines[$ref_line + 6], -1, PREG_SPLIT_NO_EMPTY);
    //print_r($departwords3);
    $departwords4 = preg_split('/[\s]+/', $samalines[$ref_line + 7], -1, PREG_SPLIT_NO_EMPTY);
    //print_r($departwords4);
    $departwords5 = preg_split('/[\s]+/', $samalines[$ref_line + 8], -1, PREG_SPLIT_NO_EMPTY);
    $departwords6 = preg_split('/[\s]+/', $samalines[$ref_line + 9], -1, PREG_SPLIT_NO_EMPTY);

    $lieudepard = $departwords1[0] . ' ' . $departwords1[1];
    $heuredepart = $departwords1[6];
    $datedepart = $departwords1[5];
    $comdepart1 = $departwords1[2];
    $comdepart2 = $departwords1[3];
    $cldepart = $departwords1[4];
    $st = $departwords1[9];
    if (!isset($departwords2[3])) {
        $lieudepard .= " " . $departwords2[0];
        if (isset($departwords2[1]))
            $lieudepard .= " " . $departwords2[1];
        $pos_ter1 = strpos($departwords3[0], "TERMINAL");
        if($pos_ter1 === false)
        {
            $lieuarrive = $departwords3[0] . ' ';
            $lieuarrive .= isset($departwords3[1])?$departwords3[1]:'';
            $intcol = 0;
            while (isset($departwords4[$intcol]) && !is_numeric($departwords4[$intcol]))
            {
                $lieuarrive .= ' '.$departwords4[$intcol];
                $intcol++;
            }
            $heurarive = $departwords4[$intcol];
        }
        else{
            $lieuarrive = $departwords4[0] . ' ';
            $lieuarrive .= isset($departwords4[1])?$departwords4[1]:'';
            $intcol = 0;
            while (isset($departwords5[$intcol]) && !is_numeric($departwords5[$intcol]))
            {
                $lieuarrive .= ' '.$departwords5[$intcol];
                $intcol++;
            }
            $heurarive = $departwords5[$intcol];
        }

        $pos = false;
        if(isset($departwords5[0]))
        {
            $terminalwords = preg_split('/[:]+/', $departwords5[0]);
            $pos = strpos($departwords5[0], "TERMINAL");
        }
        if (isset($departwords4[3]))
            $heureenreg = preg_split('/[:]+/', $departwords4[3]);

        if ($pos===false) {
            $lastligne = $ref_line + 9;
        }
        else{
            $lastligne = $ref_line + 10;
        }

    } else {
        $lieuarrive = $departwords2[0] . ' ' . $departwords2[1];
        $intcol = 0;
        while (isset($departwords3[$intcol]) && !is_numeric($departwords3[$intcol]))
        {
            $lieuarrive .= ' '.$departwords3[$intcol];
            $intcol++;
        }
        $heurarive = $departwords3[$intcol];
        $terminalwords = preg_split('/[:]+/', $departwords4[0]);
        if (isset($departwords4[3]))
            $heureenreg = preg_split('/[:]+/', $departwords4[3]);

        $pos = strpos($departwords5[0], "TERMINAL");
        if ($pos===false) {
            $lastligne = $ref_line + 8;
        }else{
            $lastligne = $ref_line + 9;
        }

    }
//    echo '<br>Lieu depart : ' . $lieudepard;
//    echo '<br>Heure depart : ' . $heuredepart;
//    echo '<br>Date depart : ' . $datedepart;
//    echo '<br>Vol depart : ' . $comdepart1 . ' ' . $comdepart2;
//    echo '<br>Statut depart : ' . $st;
//    echo '<br>Lieu Arrive : ' . $lieuarrive;
//    echo '<br>Heure Arrive : ' . $heurarive;
    if (isset($heureenreg[1])) {
        $mheureenreg = $heureenreg[1];
        //echo '<br>Heure Dernier enregistrement : ' . $mheureenreg;
    } else {
        $mheureenreg = 0;
    }
//
    $trajet['lieu_depart'] = $lieudepard;
    $trajet['heure_depart'] = $heuredepart;
    $trajet['date_depart'] = $datedepart;
    $trajet['vol_depart'] = $comdepart2;
    $trajet['statut'] = $st;
    $trajet['heure_arr'] = $heurarive;
    $trajet['lieu_arr'] = $lieuarrive;
    array_push($trajet_tab, $trajet);

    etape($lastligne, $samalines);
    $billet_trajets[$billet['numero_billet']]= $trajet_tab;
}
function etape($lastligne, $samalines) {

    global $trajet_tab;
    $trajet = array();
//    //echo "<br> Debutp bainee $lastligne";
    $pff_line = $lastligne + 1;
    $pff_line1 = $lastligne + 2;
    $est_trajet = false;
    if (preg_match("#^TERMINAL#", $samalines[$pff_line])) {
        $est_trajet = true;
    }
    if (preg_match("#^TERMINAL#", $samalines[$pff_line1])) {
        $est_trajet = true;
    }
    if (preg_match("#^TERMINAL#", $samalines[$pff_line1 + 1])) {
        $est_trajet = true;
    }
    if (preg_match("#^TERMINAL#", $samalines[$pff_line1 + 2])) {
        $est_trajet = true;
    }
    if (isset($samalines[$lastligne]) && $samalines[$lastligne]!=null && $est_trajet) {
        $departwords1 = preg_split('/[\s]+/', $samalines[$lastligne], -1, PREG_SPLIT_NO_EMPTY);
        if (isset($departwords1[0])) {
            $departwords2 = preg_split('/[\s]+/', $samalines[$lastligne + 1], -1, PREG_SPLIT_NO_EMPTY);
            $departwords3 = preg_split('/[\s]+/', $samalines[$lastligne + 2], -1, PREG_SPLIT_NO_EMPTY);
            $departwords4 = preg_split('/[\s]+/', $samalines[$lastligne + 3], -1, PREG_SPLIT_NO_EMPTY);
            $departwords5 = preg_split('/[\s]+/', $samalines[$lastligne + 4], -1, PREG_SPLIT_NO_EMPTY);
            $departwords6 = preg_split('/[\s]+/', $samalines[$lastligne + 5], -1, PREG_SPLIT_NO_EMPTY);
            $lieudepard = $departwords1[0] . ' ' . $departwords1[1];
            $heuredepart = $departwords1[6];
            $datedepart = $departwords1[5];
            $comdepart1 = $departwords1[2];
            $comdepart2 = $departwords1[3];
            $cldepart = $departwords1[4];
            $statu_depart = $departwords1[9];
            if (!isset($departwords2[3])) {
                $lieudepard .= " " . $departwords2[0];
                if (isset($departwords2[1]))
                    $lieudepard .= " " . $departwords2[1];
                //if($departwords3 )
                $terminal1words = $departwords3;
                $lieuarrive = $departwords4[0] . ' ' . $departwords4[1];
                $intcol = 0;
                while (isset($departwords5[$intcol]) && !is_numeric($departwords5[$intcol]))
                {
                    $lieuarrive .= ' '.$departwords5[$intcol];
                    $intcol++;
                }
                $heurarive = $departwords5[$intcol];
                if(isset($departwords6[0]))
                    $terminalwords = preg_split('/[:]+/', $departwords6[0]);
                if (isset($departwords5[3]))
                    $heureenreg = preg_split('/[:]+/', $departwords5[3]);
                $lastligne = $lastligne + 7;
            } else {
                $lieuarrive = $departwords2[0] . ' ' . $departwords2[1];
                                $intcol = 0;
                while (!is_numeric($departwords3[$intcol]))
                {
                    $lieuarrive .= ' '.$departwords3[$intcol];
                    $intcol++;
                }
                $heurarive = $departwords3[$intcol];
                $terminalwords = preg_split('/[:]+/', $departwords4[0]);
                if (isset($departwords4[3]))
                    $heureenreg = preg_split('/[:]+/', $departwords4[3]);
                $lastligne = $lastligne + 6;
            }
//
////            echo '<br>Lieu depart : ' . $lieudepard;
////            echo '<br>Heure depart : ' . $heuredepart;
////            echo '<br>Date depart : ' . $datedepart;
////            echo '<br>Vol depart : ' . $comdepart1 . ' ' . $comdepart2;
////            echo '<br>Statut depart : ' . $statu_depart;
////            echo '<br>Lieu Arrive : ' . $lieuarrive;
////            echo '<br>Heure Arrive : ' . $heurarive;
//            etape($lastligne, $samalines);
            $trajet['lieu_depart'] = $lieudepard;
            $trajet['heure_depart'] = $heuredepart;
            $trajet['date_depart'] = $datedepart;
            $trajet['vol_depart'] = $comdepart2;
            $trajet['statut'] = $statu_depart;
            $trajet['heure_arr'] = $heurarive;
            $trajet['lieu_arr'] = $lieuarrive;
            $trajet['terminal1'] = $terminal1words;
            $trajet['terminal'] = $terminalwords;
            array_push($trajet_tab, $trajet);
//            $enreg = "ff";
//
            etape($lastligne, $samalines);
        } else {
            echo "<br> Finito bainee $lastligne";
        }
    } else {
        //echo "<br> Finito bainee $lastligne";
    }

}

$data = ['nb_billets'=>$news, 'billets'=>$tab_billet, 'billet_trajets'=>$billet_trajets];
echo json_encode($data);
?>