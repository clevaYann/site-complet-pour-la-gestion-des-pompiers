<?php
/**
 * \file      c_logout.php
 * \author    BTS SN IR
 * \version   1.0
 * \date      décembre 2017
 * \brief     Controleur qui gère déconnexion de l'administrateur.
 * \details   Fermeture de la session et redireciton vers la page acceuil.
 */
unset($_SESSION['auth']);
?>
<div class="container">
  <div class="alert alert-success">
    Vous êtes maintenant déconnecté
  </div>
</div>

<?php header('Location: index.php?controleur=informer&action=demandeAccueil'); ?>