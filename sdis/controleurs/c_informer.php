<?php

/**
 * \file      c_gererAdmin.php
 * \author    BTS SN IR
 * \version   1.0
 * \date      décembre 2017
 * \brief     Controleur qui gère toutes les demandes d'actions liées index.php/informer.
 * \details   Concerne l'afficahge des pages accueiln, centre et stats
 */
$action = $_REQUEST['action'];
switch($action)
{
    case 'demandeAccueil': {
            include("vues/v_accueil.htm");
            break;
        }
    case 'demandeCentre' : {
            include("vues/v_centre.htm");
            break;
        }
    case 'demandeStats' : {
            include("vues/v_stats.htm");
            break;
        }		
}

