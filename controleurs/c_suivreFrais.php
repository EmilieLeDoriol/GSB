<?php
include("vues/v_sommaireComptable.php");
$action = $_REQUEST['action'];
$rembourse = false;
switch($action){
        case "selectionnerFiche": {
                $lesFiches = $pdo->getFraisValide();
                include("vues/v_listeFraisValide.php");
                break;
        }
        case "voirFiche": {
                if (isset($_REQUEST['choixFiche'])) {
                        $fiche = $_REQUEST['choixFiche'];
                        $_SESSION['fiche'] = $fiche;
                        list($id, $mois) = explode("/",$fiche);
                } else {
                        $fiche = $_SESSION['fiche'];
                        list($id, $mois) = explode("/",$fiche);
                        $pdo->majEtatFicheFrais($id, $mois, 'RB');
                        $rembourse = true;
                        $messageRembourse = "Cette fiche est désormais à l'état 'REMBOURS&#201E'.";
                        $disable = 'disabled="disabled"';
                }
                $lesFiches = $pdo->getFraisValide();
                $ficheASelectionner = $id.$mois;
                include("vues/v_listeFraisValide.php");
                $infosVisiteur = $pdo->getNomPrenom($id);
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id, $mois);
                $lesFraisForfait= $pdo->getLesFraisForfait($id, $mois);
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($id, $mois);
                $numAnnee =substr($mois,0,4);
                $numMois =substr($mois,4,2);
                $libEtat = $lesInfosFicheFrais['libEtat'];
                $montantValide = $lesInfosFicheFrais['montantValide'];
                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                $dateModif =  $lesInfosFicheFrais['dateModif'];
                $dateModif =  dateAnglaisVersFrancais($dateModif);
                include("vues/v_suiviFrais.php");
                break;
        }
    
}
?>
