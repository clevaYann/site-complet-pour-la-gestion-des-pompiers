<!-- Deboguage -->
<!-- <?php
// var_dump($nbSapeurs) ;
// print_r($nbSapeurs) ;
echo $nbSapeursSeize;
?> -->
<!-- centrage du texte selon les nomres actuelles 1200 pix max -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h5> Liste des volontaires <a href=index.php?controleur=gererAdministration&action=demandeAjoutSapeur class="btn btn-success btn-xs">Ajouter</a></h5>
        </div>
      </div>
    </div>

    <div class="col-lg-8">                                                                                      <!-- Tableau largeur 8/12 -->
        <table class="table table-striped table-hover ">
            <thead>
              <tr class="info">                                                                                  <!-- couleur violette -->
                <th>Id</th>
                <th>Email</th>
                <th><a href="index.php?controleur=gererAdministration&action=listeAgeSapeurs">Age</th>            <!-- lien qui lance la requêtde de tri ascendant -->
                <th><a href="index.php?controleur=gererAdministration&action=listeBrevetSapeurs">Brevet</a></th>  <!-- lien qui lance la requêtde de tri selon brvet oui ou non -->
                <th class="text-center">Supprimer</th>
                <th class="text-center">Modifier</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($listeSapeurs as $cle=>$valeur): ?>                       <!-- On déroule le tableau résultat de la requête pour compléter le tableau HTML de la page -->
              <tr>
                 <?php foreach ($valeur as $val): ?>
                    <td>
                      <?php echo $val ?>                  
                    </td>
                  <?php endforeach; ?>
                    <td class="text-center">                                                                              <!-- Requête GET pour identifier le sapeur à supprimer -->
                      <a href=index.php?controleur=gererAdministration&action=DelSapeurs&delete=<?php echo $valeur['id'] ?>  
                         onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?php echo $valeur['id'] ?> ?'));" class="btn btn-danger btn-xs">SUPPR</a>
                    </td>
                    <td class="text-center">                                                                              <!-- Requête GET pour identifier le sapeur à MAJ -->
                      <a href=index.php?controleur=gererAdministration&action=demandeMiseAjourSapeur&id=<?php echo $valeur['id'] ?> class="btn btn-default btn-xs">MAJ</a>
                    </td>    
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="col-lg-4">
        <table class="table table-striped table-hover ">
          <thead>
            <tr class="success">
              <th>Tranches d'âge</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Nb de Brevet</th>
            </tr>
          </thead>
          <tbody>   <!-- On remplit le tableau depuis les requêtes SQL. Veiller à ne pas laisser les résultats des requêtes sous forme de tableau impossible à utiliser-->
            <tr>    <!-- comme simple valeur (echo est impossible) mais sous forme d'objet : exemple : $resRequete->nbSapeurs; -->
              <td>16-18 ans</td><td class="text-center"><?php echo $nbSapeursSeize; ?></td><td class="text-center"><?php echo $nbSapeursSeizeBrevet; ?></td>
            </tr>
            <tr>
              <td>18-25 ans</td><td class="text-center"><?php echo $nbSapeursDixHuit; ?></td><td class="text-center"><?php echo $nbSapeursDixHuitBrevet; ?></td>
            </tr>
            <tr>
              <td>25-40 ans</td><td class="text-center"><?php echo $nbSapeursVingtCinq; ?></td><td class="text-center"><?php echo $nbSapeursVingtCinqBrevet; ?></td>
            </tr>
            <tr>
              <td>sup à 40 ans</td><td class="text-center"><?php echo $nbSapeursQuaranteSup; ?></td><td class="text-center"><?php echo $nbSapeursQuaranteSupBrevet; ?></td>
            </tr>
            <tr class="warning">
              <td>Totaux</td><td class="text-center"><?php echo $nbSapeurs; ?></td><td class="text-center"><?php echo $nbSapeursBrevet; ?></td>
            </tr>
          </tbody>
        </table> 
      </div>
    </div>
  </div>
 </div>