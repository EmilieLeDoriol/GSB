<div id="contenu">    
    <div>
        <div>
            <form action="index.php?uc=suivreFrais&action=voirFiche" method="post">
                <h1> Suivi du paiement des frais </h1>
                <label>Choisir la fiche de frais:</label>
                <select name="choixFiche">
                    <?php
                        foreach ($lesFiches as $uneFiche) {
                            $prenom = $uneFiche['prenom'];
                            $nom = $uneFiche['nom'];
                            $idVisiteur = $uneFiche['id'];
                            $unMois = $uneFiche['mois'];
                            $numAnnee =substr( $unMois,0,4);
                            $numMois =substr( $unMois,4,2);
                            $visiteurMois = $idVisiteur.$unMois;
                            if ($visiteurMois == $ficheASelectionner) {
                                ?><option selected value="<?php echo $idVisiteur.'/'.$unMois?>"><?php echo $nom." ".$prenom. ' : '.$numMois.'/'.$numAnnee?></option><?php   
                            } else {
                    ?> 
                            <option value="<?php echo $idVisiteur.'/'.$unMois?>"><?php echo $nom." ".$prenom. ' : '.$numMois.'/'.$numAnnee?></option>   
                    <?php
                            }
                        }
                    ?>
                </select>
                <div>
                    <p>
                        <input id="ok" type="submit" value="Valider" size="20" />
                    </p> 
                </div>
            </form>
        </div>
    </div>
