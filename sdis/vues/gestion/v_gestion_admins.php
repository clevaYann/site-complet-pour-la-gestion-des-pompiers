<!-- Même principe que v_gestion_sapeurs.php mais pas configuré --> 
    <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="page-header">
                <h5> Liste des administrateurs</h5>
              </div>
            </div>
          </div>

        <div class="col-lg-8">
            <table class="table table-striped table-hover ">
                <thead>
                  <tr class="success">
                    <th>Id</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Supprimer</th>
                    <th>Modifier</th>
                  </tr>
                </thead>
                <?php foreach ($listeAdmins as $cle=>$valeur): ?>
                  <tr>
                     <?php foreach ($valeur as $val): ?>
                        <td>
                          <?php echo $val ?>                  
                        </td>
                      <?php endforeach; ?>
                        <td>
                          <a href=............=<?php echo $valeur['id'] ?> 
                             onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?php echo $valeur['id'] ?> ?'));" class="btn btn-danger btn-xs">SUPPR</a>
                        </td>
                        <td>
                          <a href=............?id=<?php echo $valeur['id'] ?> class="btn btn-default btn-xs">MAJ</a>
                        </td>    
                  </tr>
                <?php endforeach; ?>
            </table>
          </div>
      </div>
  </div>