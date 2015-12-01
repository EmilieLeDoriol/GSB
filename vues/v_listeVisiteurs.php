    <div>
            <div>
            <form action="index.php?uc=validerFrais&action=voirFraisVisiteur" method="post">
                    <h1> Validation des frais par visiteur </h1>
                    <label>Choisir le visiteur :</label>
                            <select name="visiteur">
                                <?php
                                        foreach ($lesVisiteurs as $unVisiteur) {
                                            $nom = $unVisiteur['nom'];
                                            $prenom = $unVisiteur['prenom'];
                                            $id = $unVisiteur['id'];
                                            ?> 
                                            <option value="<?php echo $id?>"><?php echo $nom." ".$prenom?></option>   
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