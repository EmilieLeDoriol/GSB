    <div>Etat: <?php echo $libEtat; ?></div>
    <div>Montant validé: <?php echo $montantValide;?></div>
    <div>Date de dernière modification: <?php echo $dateModif;?></div>
    <br>
    

    <form action="index.php?uc=validerFrais&action=valideFrais" method="post">
        <div><h2>Frais au forfait </h2></div>
        <table>
                <tr><th>Etape</th><th>Km </th><th>Nuitée</th><th>Repas midi</th></tr>
                <tr align="center">
                    <?php 
                        foreach ( $lesFraisForfait as $unFraisForfait ) {
                            $quantite = $unFraisForfait['quantite'];
                            $idFrais = $unFraisForfait['idfrais'];
                            ?>
                            <td width="80"><input id="idFrais" type="text" size="3" name="lesFrais[<?php echo $idFrais?>]" value="<?php echo $quantite?>"/></td>
                            <?php  
                        }
                    ?>
                </tr>
        </table>
		
        <p class="titre" />
        <div ><h2>Hors Forfait</h2></div>
        <table>
                <?php 
                    if (empty($lesFraisHorsForfait)) {
                        ?>Il n'y a pas de frais hors forfait.<?php
                    }
                    else {
                        ?><tr><th>Date</th><th>Libellé </th><th>Montant</th>
                            <?php
                                if (!$dejaValide) {
                                    ?><th>Supprimer</th><th>Reporter</th></tr><?php
                                }
                            
                        foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) {
                            $date = $unFraisHorsForfait['date'];
                            $libelle = $unFraisHorsForfait['libelle'];
                            $montant = $unFraisHorsForfait['montant'];
                            $idHorsForfait = $unFraisHorsForfait['id'];
                            ?>
                            <tr>
                                <td width="100" ><input type="text" size="12" name="hfDate[<?php echo $idHorsForfait ?>]" value="<?php echo $date?>"/></td>
                                <td width="220"><input type="text" size="40" name="hfLib[<?php echo $idHorsForfait ?>]" value="<?php echo $libelle?>"/></td> 
                                <td width="90"> <input type="text" size="10" name="hfMont[<?php echo $idHorsForfait ?>]" value="<?php echo $montant?>"/></td>
                                <?php
                                if (!$dejaValide) {
                                    ?><td><a href="index.php?uc=validerFrais&action=supprimerFrais&idHorsForfait=<?php echo $idHorsForfait ?>" 
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer</a></td>
                                    <td><a href="index.php?uc=validerFrais&action=reporterFrais&idHorsForfait=<?php echo $idHorsForfait ?>" 
                                    onclick="return confirm('Voulez-vous vraiment reporter ce frais?');">Reporter</a></td><?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                ?>
        </table>		
        <p>Nb Justificatifs&nbsp;<input type="text" class="zone" size="4" name="nbJustificatifs" value="<?php echo $nbJustificatifs ?>"/><p/>
        <?php 
            if(!empty($message)) {
                echo $message;
            }
            if ($dejaValide) {
                echo $messageDejaValide;
            }
        ?>
        <div><input class="zone"type="reset" /><input class="zone" <?php if ($dejaValide){echo $disable;}?> type="submit" value="VALIDER LA FICHE"/></div>

    </form>
</div>
