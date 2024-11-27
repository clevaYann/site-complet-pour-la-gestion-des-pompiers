<?php

/**
 * \file      c_gererAdmin.php
 * \author    BTS SN IR
 * \version   1.0
 * \date      décembre 2017
 * \brief     Controleur qui gère toutes les demandes d'actions liées index.php/gererInscriptions.
 * \details   Toutes les demandes d'actions liées à l'inscription des psotulants sapeurs sont traitées ici
 */
$action = $_REQUEST['action'];
/**
 * On commence par afficher le formulaire d'incription
 */
switch ($action) {
    case 'demandeInscription': {
            include("vues/form/v_formInscriptions.htm");                        // 
            break;
        }
    /*
     * On récupère les valeurs entrées lors de la soummission
     */
    case 'traitementInscription': {                                             // puis  
            $lAge = $_REQUEST['age'];
            $leBrevet = $_REQUEST['brevet'];
            $lEmail = $_REQUEST['email1'];
            $lEmail2 = $_REQUEST['email2'];
            /*
             * on vérifie que les 2 emails sont identiques. Si non identique on envoie un message demandant de recommencer v_messageErreurs.php
             * Si les 2 Emails sont bien identiques on vérifie que l'email n'est pas déjà dans la BDD class.pdoBdSdis.php
             * Si tout est OK on inscrit le postulant et on l'informe que c'est bon v_messageInscription.php
             * Sinon on lui dit que l'email existe déjà dans la BDD v_messageRejetMail.php
             */
            if ($lEmail !== $lEmail2) {
                $erreur = 1;
                include("vues/msg/v_messageErreurs.php");
                exit;
            } else {
                //echo "OK Vérif";
                $verifEmail = PdoBdSdis::getLEmail($lEmail);
                if ($verifEmail == false) {
                    $inscriptions = $connexion->insererVolontaire($lEmail, $lAge, $leBrevet); // 
                    include("vues/msg/v_messageInscription.php");                              // 
                } else {
                    include("vues/msg/v_messageRejetMail.php");             // 
                }
            }
            break;
        }
}

