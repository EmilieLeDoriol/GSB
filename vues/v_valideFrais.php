    <form>
        <div><h2>Frais au forfait </h2></div>
        <table>
                <tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th></tr>
                <tr align="center">
                    <?php 
                        foreach ( $lesFraisForfait as $unFraisForfait ) {
                            $quantite = $unFraisForfait['quantite'];
                            $libelle = $unFraisForfait['idfrais'];
                            ?>
                            <td width="80"><input type="text" size="3" name="<?php echo $libelle ?>" 
                                                 value="<?php echo $quantite?>"/></td>
                            <?php  
                        }
                    ?>
                        <td width="80"> 
                                <select size="3" name="situ">
                                        <option value="E">Enregistré</option>
                                        <option value="V">Validé</option>
                                        <option value="R">Remboursé</option>
                                </select>
                        </td>
                </tr>
        </table>
		
        <p class="titre" />
        <div ><h2>Hors Forfait</h2></div>
        <table>
                <tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th></tr>
                <tr align="center">
                        <?php 
                            $i = 1;
                            foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) {
                                $date = $unFraisHorsForfait['date'];
                                $libelle = $unFraisHorsForfait['libelle'];
                                $montant = $unFraisHorsForfait['montant'];
                                ?>
                                <tr>
                                    <td width="100" ><input type="text" size="12" name="hfDate<?php echo $i ?>" value="<?php echo $date?>"/></td>
                                    <td width="220"><input type="text" size="30" name="hfLib<?php echo $i ?>" value="<?php echo $libelle?>"/></td> 
                                    <td width="90"> <input type="text" size="10" name="hfMont<?php echo $i ?>" value="<?php echo $montant?>"/></td>
                                    <td width="80"> 
                                        <select size="3" name="hfSitu1">
                                                <option value="E">Enregistré</option>
                                                <option value="V">Validé</option>
                                                <option value="R">Remboursé</option>
                                        </select>
                                    </td>   
                                </tr>
                                <?php
                                $i++;
                            }
                        ?>

                </tr>
        </table>		
        <p>Nb Justificatifs&nbsp;<input type="text" class="zone" size="4" name="hcMontant" value="<?php echo $nbJustificatifs ?>"/><p/>
        <input class="zone"type="reset" /><input class="zone"type="submit" />
    </form>
</div>
