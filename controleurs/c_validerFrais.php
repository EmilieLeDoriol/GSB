<?php
include("vues/v_sommaireComptable.php");
$mois = getMois(date("d/m/Y"));
$jour = getJour(date("d/m/y"));
$action = $_REQUEST['action'];
switch($action){
        case 'selectionnerVisiteur':{
                $lesVisiteurs = $pdo->getInfosVisiteurs();
                include("vues/v_listeVisiteurs.php");
                break;
        }
        case 'voirFraisVisiteur':{                
                $moisChoisi = false;
                $lesVisiteurs = $pdo->getInfosVisiteurs();
                // si un visiteur a été sélectionné, on sauvegarde celui-ci
                if (isset($_POST['visiteur'])) {
                    $_SESSION['idVisiteur'] = $_POST['visiteur'];
                }
                // on revalorise la variable si aucun autre visiteur n'a été sélectionné
                // et on récupère son nom et prénom pour pouvoir l'afficher
                $idVisiteur = $_SESSION['idVisiteur'];
                $infosVisiteur = $pdo->getNomPrenom($idVisiteur);
                // on affiche les mois disponibles pour ce visiteur
                $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
                // si un autre mois a été sélectionné, on remplace les variables existantes
                // et on passe le flag de changement de mois à vrai
                if (isset($_POST['mois'])) {
                    $_SESSION['mois'] = $_POST['mois'];
                    $mois = $_SESSION['mois'];
                    $moisASelectionner = $mois;
                    $moisChoisi = true;
                }
                // si la fiche de frais de ce mois n'existe pas
                // on recherche la dernière fiche de frais de ce visiteur
                if($pdo->estPremierFraisMois($idVisiteur,$mois)){
                    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $pdo->dernierMoisSaisi($idVisiteur));
                    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $pdo->dernierMoisSaisi($idVisiteur));
                    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$pdo->dernierMoisSaisi($idVisiteur));
                } else {
                    // la fiche de frais existe et aucun autre mois n'a été sélectionné
                    if ($jour < 10 && $moisChoisi == false) {
                        // si on est en début de mois, on affiche la fiche du mois précédent
                        // et on met à jour le mois à sélectionner dans la liste déroulante
                        $moisASelectionner = $lesCles[1];
                        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois-1);
                        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois-1);
                        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$mois-1);
                    } else {
                        // sinon, on affiche celle de ce mois
                        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
                        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
                        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$mois);
                    }
                }
                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                include("vues/v_formVisiteurMois.php");
                include("vues/v_valideFrais.php");
                break;
                
        }    
}
?>