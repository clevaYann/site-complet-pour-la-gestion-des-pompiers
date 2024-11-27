<?php

/**
 * \file      c_gererInscriptions.php
 * \author    BTS SN IR
 * \version   1.0
 * \date      décembre 2017
 * \brief     Controleur qui gère toutes les demandes d'actions liées index.php/gererAdministration.
 * \details   Les données affcihées ne sont accesblies que depuis les pages "Administration"
 */
$action = $_REQUEST['action'];                                               

switch ($action)
{
    /**
     * On affiche le formulaire d'identification spécifique à l'administrateur
     */
    case 'demandeAuthentification': {                                       
            include("vues/layout/v_layout_entete.php") ;
            include("vues/form/v_formAdmin.htm");
            break;
        }
    /**
     * \brief     On vérifie que les identifiants de l'admin sont bons
     * \details   Le mot de passe est hashé (sha256) pour ne pas être stocké en clair dans la BBD
     *            Si c'est conforme on le redirige vers la page admin,sinon il reçoit un message de rejet
     * \$param     LeUsername : identifiant de l'administrateur récupéré depuis le formulaire
     * \$param     LePassword : mot de passe hashé de l'administrateur
     * \retun      string si identifiant et mdp pérsent dans la BDD on redirige vers la page de listage des Admins sinon on envooie un message d'érreur
     */
    case 'authentification': {                                               
            $leUsername = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $lePassword = hash('sha256', $password);                        
            $authAdmin = PdoBdSdis::getLAdmin($leUsername, $lePassword);
            if ($authAdmin != null) { 
                header('Location: index.php?controleur=gererAdministration&action=listeAdmins'); 
            }
            else {
            include("vues/layout/v_layout_entete.php");
            include("vues/msg/v_messageAdminRejet.php");
            }
            break;
        }
   /**
    * \brief     Toutes ces requêtes servent à remplir les tableaux donnant les infos sur les sapeurs (v_gestion_sapeurs.php)
    * \details   Liste tous les postulants sapeurs présents dans la base de données
    *            Permet de récupérer le nombre de postulants sapeur par travche d'âge et possédant ou pas le brevet.
    * 
    */
    case 'listeSapeurs': {                                                                       
            $listeSapeurs = TabSapeurs::getListeSapeur();
            $nbSapeurs = TabSapeurs::getNbSapeurs();
            $nbSapeursSeize = TabSapeurs::getSapeursSeize();
            $nbSapeursDixHuit = TabSapeurs::getSapeursDixHuit();
            $nbSapeursVingtCinq = TabSapeurs::getSapeursVingtCinq();
            $nbSapeursQuaranteSup = TabSapeurs::getSapeursQuaranteSup();

            $nbSapeursBrevet = TabSapeurs::getNbSapeursBrevet();
            $nbSapeursSeizeBrevet = TabSapeurs::getSapeursSeizeBrevet();
            $nbSapeursDixHuitBrevet = TabSapeurs::getSapeursDixHuitBrevet();
            $nbSapeursVingtCinqBrevet = TabSapeurs::getSapeursVingtCinqBrevet();
            $nbSapeursQuaranteSupBrevet = TabSapeurs::getSapeursQuaranteSupBrevet();
            include("vues/layout/v_layout_entete_admin.php");
            include("vues/gestion/v_gestion_sapeurs.php");
            break;
        }
    
    /**
    * \brief    Toutes ces requêtes servent à remplir les tableaux donnant les infos sur les sapeurs (v_gestion_sapeurs.php)
    * \details  Affichere les sapeurs possédant le brevet. On fait une demande de requête SELECT vers classTabSapeurs.php
    */    
    case 'listeBrevetSapeurs': {                                                                
            $listeSapeurs = TabSapeurs::getListeBrevetSapeur();                                  
            $nbSapeurs = TabSapeurs::getNbSapeurs();
            $nbSapeursSeize = TabSapeurs::getSapeursSeize();
            $nbSapeursDixHuit = TabSapeurs::getSapeursDixHuit();
            $nbSapeursVingtCinq = TabSapeurs::getSapeursVingtCinq();
            $nbSapeursQuaranteSup = TabSapeurs::getSapeursQuaranteSup();

            $nbSapeursBrevet = TabSapeurs::getNbSapeursBrevet();
            $nbSapeursSeizeBrevet = TabSapeurs::getSapeursSeizeBrevet();
            $nbSapeursDixHuitBrevet = TabSapeurs::getSapeursDixHuitBrevet();
            $nbSapeursVingtCinqBrevet = TabSapeurs::getSapeursVingtCinqBrevet();
            $nbSapeursQuaranteSupBrevet = TabSapeurs::getSapeursQuaranteSupBrevet();
            include("vues/layout/v_layout_entete_admin.php");                                  
            include("vues/gestion/v_gestion_sapeurs.php");
            break;
        }

    /**
    * \brief    Toutes ces requêtes servent à remplir les tableaux donnant les infos sur les sapeurs (v_gestion_sapeurs.php)
    * \details  Affichera les sapeurs selon les tranches d'âge ascendantes. On fait une demande de requête SELECT vers classTabSapeurs.php
    */         
     case 'listeAgeSapeurs': {        
            $listeSapeurs = TabSapeurs::getListeAgeSapeur();                                     
            $nbSapeurs = TabSapeurs::getNbSapeurs();
            $nbSapeursSeize = TabSapeurs::getSapeursSeize();
            $nbSapeursDixHuit = TabSapeurs::getSapeursDixHuit();
            $nbSapeursVingtCinq = TabSapeurs::getSapeursVingtCinq();
            $nbSapeursQuaranteSup = TabSapeurs::getSapeursQuaranteSup();

            $nbSapeursBrevet = TabSapeurs::getNbSapeursBrevet();
            $nbSapeursSeizeBrevet = TabSapeurs::getSapeursSeizeBrevet();
            $nbSapeursDixHuitBrevet = TabSapeurs::getSapeursDixHuitBrevet();
            $nbSapeursVingtCinqBrevet = TabSapeurs::getSapeursVingtCinqBrevet();
            $nbSapeursQuaranteSupBrevet = TabSapeurs::getSapeursQuaranteSupBrevet();
            include("vues/layout/v_layout_entete_admin.php");
            include("vues/gestion/v_gestion_sapeurs.php");
            break;
        }
    /**
    * \brief    Suppresion d'un postulant sapeur
    * \details  On récupère l'id su sapeur à supprimer, on lance la demande de requête DELETE vers class.pdoBdSdis.php
     *          et enfin on relance une requête SELECT pour mettre $listeSapeurs à jour
    */  
    case 'DelSapeurs': {                                                                        
            $Lid = $_GET['delete'];                                                             
            $DelSapeurs = $connexion->DelSapeur($Lid);                                          
            $listeSapeurs = TabSapeurs::getListeSapeur();                                       
            header('Location: index.php?controleur=gererAdministration&action=listeSapeurs');
            include("vues/layout/v_layout_entete_admin.php");
            include("vues/gestion/v_gestion_sapeurs.php");
            break;
        }

    /**
    * \brief    On affiche le formulaire pour modification des informations d'un postulant sapeur
    * \details  On récupère l'id su sapeur à modifier, on lance la demande de requête SELECT vers class.pdoBdSdis.php pour récupérer les infos de ce sapeur
     *          On affiche le formulaire de MAJ qui conserve l'email retourné par la requête.
    */      
        
    case 'demandeMiseAjourSapeur': {                                                 
            $Lid = $_GET['id'];                                                     
            var_dump($Lid);
            $MajSapeur = PdoBdSdis::getSapeur($Lid);
            include("vues/layout/v_layout_entete.php");                             
            include("vues/form/v_formMaj.htm");
            break;
        }

    /**
    * \brief    Modification des informations d'un postulant sapeur
    * \details  On récupère les infos soumises lors de a MAJ
     *          On lance la demande de requête UPDATE vers class.pdoBdSdis.php.
     *          On relance une requête SELECT pour mettre $listeSapeurs à jour
    */   
        
    case 'TraitementMiseAjourSapeur': {                                             
            $lAge = $_REQUEST['age'];
            $leBrevet = $_REQUEST['brevet'];
            $lEmail = $_REQUEST['email1'];
            $Lid = $_REQUEST['id'];
            $UpdateSapeurs = $connexion->UpdateSapeur($Lid, $lEmail, $lAge, $leBrevet); 
            $listeSapeurs = TabSapeurs::getListeSapeur();                                
            header('Location: index.php?controleur=gererAdministration&action=listeSapeurs');
            include("vues/layout/v_layout_entete_admin.php");
            include("vues/gestion/v_gestion_sapeurs.php");
            break;
        }

    case 'demandeAjoutSapeur': {
            include("vues/layout/v_layout_entete.php");
            include("vues/form/v_formAjoutSapeur.htm");
            break;
        } 


    /**
    * \brief    On affiche le formulaire pour l'inscription d'un postulant sapeur mais depuis la page d'administration
    */ 
        
    case 'traitementAjoutSapeur': {                                                    
        include("vues/layout/v_layout_entete_admin.php");
            $lAge = $_REQUEST['age'];
            $leBrevet = $_REQUEST['brevet'];
            $lEmail = $_REQUEST['email1'];
            $lEmail2 = $_REQUEST['email2'];
            
                if ($lEmail!==$lEmail2){
                    $erreur = 1;
                    include("vues/msg/v_messageErreurs.php");
                    exit;
                    }
                else{
                    $verifEmail = PdoBdSdis::getLEmail($lEmail);
                    if ($verifEmail==false) {
                        $inscriptions = $connexion->insererVolontaire($lEmail, $lAge, $leBrevet);
                        $_SESSION['flash']['success'] = "Le sapeur postulant a bien été inséré dans la base de données.";
                        $ajout=1;
                        header('Location: index.php?controleur=gererAdministration&action=listeSapeurs');
                        include("vues/gestion/v_gestion_sapeurs.php");
                        }
                    else{
                        include("vues/msg/v_messageRejetMail.php");
                        }
                    }
            break;
        }

    /**
    * \brief    Affichage des des administrateurs
    * \details  On récupère les infos soumises lors de a MAJ
     *          On lance la demande de requête UPDATE vers class.pdoBdSdis.php.
     *          On relance une requête SELECT pour mettre $listeSapeurs à jour
    */       
        
   case 'listeAdmins': {
            $listeAdmins = TabAdmins::getListeAdmin();                                 // on lance la demande de requête pour remplir le tableaux donnant les infos sur les Admins
            include("vues/layout/v_layout_entete_admin.php");
            include("vues/gestion/v_gestion_admins.php");
            break;
        }

    case 'logout': {
            include("c_logout.php") ;                                                 // l'Admin demande à se déconnecter.
            break;
        }
}
?>