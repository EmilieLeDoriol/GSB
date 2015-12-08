    <div>
            <div>
            <form action="index.php?uc=suiviFrais&action=voirFraisVisiteur" method="post">
                    <h1> Suivi du paiement des frais </h1>
                    <label>Choisir la fiche de frais:</label>
                            <select name="choixFiche">
                                <?php
                                        foreach ($lesFiches as $uneFiche) {
                                            $prenom = $uneFiche['prenom'];
                                            $nom = $uneFiche['nom'];
                                            $idVisiteur = $uneFiche['id'];
                                            $mois = $uneFiche['mois'];
                                            $numAnnee =substr( $mois,0,4);
                                            $numMois =substr( $mois,4,2);
                                            ?> 
                                            <option value="<?php echo $idVisiteur.'/'.$mois?>"><?php echo $nom." ".$prenom. ' : '.$numMois.'/'.$numAnnee?></option>   
                                            <?php
                                        }
                                ?>
                            </select>
                             
                    <div>
                        <p>
                          <input id="ok" type="submit" value="Valider" size="20" />
                          <input id="annuler" type="reset" value="Effacer" size="20" />
                        </p> 
                    </div>
            </form>
            </div>
    </div>
</div>