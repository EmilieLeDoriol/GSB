<div id="contenu">
            <div>
            <form action="index.php?uc=validerFrais&action=majVisiteur" method="post">
                    <h1> Validation des frais de <?php echo $infosVisiteur['prenom']." ".$infosVisiteur['nom']." du ".$afficheMois;?></h1>
                    <label>Choisir le visiteur :</label>
                            <select name="visiteur">
                                <?php
                                        foreach ($lesVisiteurs as $unVisiteur) {
                                            $nom = $unVisiteur['nom'];
                                            $prenom = $unVisiteur['prenom'];
                                            $id = $unVisiteur['id'];
                                            if($id == $idVisiteur){
                                            ?>
                                            <option selected value="<?php echo $id ?>"><?php echo  $nom." ".$prenom ?> </option>
                                            <?php 
                                            } else {
                                            ?> 
                                            <option value="<?php echo $id?>"><?php echo $nom." ".$prenom?></option>   
                                            <?php
                                            }
                                        }
                                ?>
                            </select>
                            <input id="ok" type="submit" value="Valider" size="20" />
            </form>
            <form action="index.php?uc=validerFrais&action=majMois" method="post">
                    <label>Choisir le mois :</label>
                    <select id="lstMois" name="mois">
                    <?php
                                foreach ($lesMois as $unMois)
                                {
                                        $mois = $unMois['mois'];
                                        $numAnnee =  $unMois['numAnnee'];
                                        $numMois =  $unMois['numMois'];
                                        if($mois == $moisASelectionner){
                                        ?>
                                        <option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                                        <?php 
                                        }
                                        else{ ?>
                                        <option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                                        <?php 
                                        }

                                }

                    ?>    
                    </select>
                    <input id="ok" type="submit" value="Valider" size="20" />
            </form>
            </div>
