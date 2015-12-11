<?php
include("vues/v_sommaireComptable.php");
$action = $_REQUEST['action'];
$dejaValide = false;
switch($action){
        case 'selectionnerVisiteur':{
                $lesVisiteurs = $pdo->getInfosVisiteurs();
                include("vues/v_listeVisiteurs.php");
                break;
        }
        case 'voirFraisVisiteur':{       
                $lesVisiteurs = $pdo->getInfosVisiteurs();
                $_SESSION['idVisiteur'] = $_POST['choixVisiteur'];
                $idVisiteur = $_SESSION['idVisiteur'];
                $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$lesCles = array_keys($lesMois);
		$moisASelectionner = $lesCles[0];
                $_SESSION['mois'] = $moisASelectionner;
                $mois = $moisASelectionner;
                break;
                
        }
        case "majVisiteur": {
                $_SESSION['idVisiteur'] = $_POST['visiteur'];
                $idVisiteur = $_SESSION['idVisiteur'];
                $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
                $lesCles = array_keys( $lesMois );
                $moisASelectionner = $lesCles[0];
                $_SESSION['mois'] = $moisASelectionner;
                $mois = $moisASelectionner;
                break;
        }
        case "majMois": {
                $_SESSION['mois'] = $_POST['mois'];
                $mois = $_SESSION['mois'];
                $idVisiteur = $_SESSION['idVisiteur'];
                $moisASelectionner = $mois;
                break;
        }
        case "valideFrais": {
                $mois = $_SESSION['mois'];
                $moisASelectionner = $mois;
                $idVisiteur = $_SESSION['idVisiteur'];
                $infosVisiteur = $pdo->getNomPrenom($idVisiteur);
                $lesFrais = $_REQUEST['lesFrais'];
                $nbJustificatifs = $_REQUEST['nbJustificatifs'];
                $pdo->majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs);
                if(lesQteFraisValides($lesFrais)){
                        $pdo->majFraisForfait($idVisiteur,$mois,$lesFrais);
                        $message = ("Les modifications ont bien été prises en compte.");
                }else{
                        ajouterErreur("Les valeurs des frais doivent être numériques");
                        include("vues/v_erreurs.php");
                }
                $montantValide = $pdo->calculerMontant($idVisiteur, $mois, $lesFrais);
                $pdo->majMontant($idVisiteur, $mois, $montantValide);
                $etat = 'VA';
                $pdo->majEtatFicheFrais($idVisiteur, $mois, $etat);
                break;
        }
        case "supprimerFrais": {
                $mois = $_SESSION['mois'];
                $moisASelectionner = $mois;
                $idVisiteur = $_SESSION['idVisiteur'];
                $idHorsForfait = $_REQUEST['idHorsForfait'];
                $pdo->refuserFrais($idHorsForfait);
                break;
        }
        case "reporterFrais": {
                $idHorsForfait = $_REQUEST['idHorsForfait'];
                $mois = $_SESSION['mois'];
                $moisASelectionner = $mois;
                $idVisiteur = $_SESSION['idVisiteur'];
                $ligneHorsForfait = $pdo->getInfosHorsForfait($idHorsForfait);
                $libelle = $ligneHorsForfait['libelle'];
                $date = $ligneHorsForfait['date'];
                $date = dateAnglaisVersFrancais($date);
                $montant = $ligneHorsForfait['montant'];
                $pdo->reporterFrais($idVisiteur, $mois, $libelle, $date, $montant);
                $pdo->supprimerFraisHorsForfait($idHorsForfait);
                break;
        }
}

if ($action != "selectionnerVisiteur") {
        $infosVisiteur = $pdo->getNomPrenom($idVisiteur);
        $lesVisiteurs = $pdo->getInfosVisiteurs();
        $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$mois);
        $afficheMois =substr( $moisASelectionner,4,2)."/".substr( $moisASelectionner,0,4);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $idEtat = $lesInfosFicheFrais['idEtat'];
        if ($idEtat == 'VA' || $idEtat == 'RB') {
                $dejaValide = true;
                $messageDejaValide = "Vous ne pouvez pas modifier une fiche déjà validée ou remboursée.";
                $disable = 'disabled="disabled"';
        }
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif =  $lesInfosFicheFrais['dateModif'];
        $dateModif =  dateAnglaisVersFrancais($dateModif);
        $dateUnMois = moisFutur($mois);
        include("vues/v_formVisiteurMois.php");
        include("vues/v_valideFrais.php");
}
?>