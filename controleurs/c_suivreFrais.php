<?php
include("vues/v_sommaireComptable.php");
$action = $_REQUEST['action'];
switch($action){
    case "selectionnerFiche": {
        $lesFiches = $pdo->getFraisValide();
        include("vues/v_listeFraisValide.php");
        break;
    }
    case "voirFiche": {
        break;
    }
    
}
?>