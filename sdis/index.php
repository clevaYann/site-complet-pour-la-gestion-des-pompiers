<?php

session_start();
require_once("modeles/classPdoBdSdis.php");
require_once("modeles/classTabSapeurs.php");
require_once("modeles/classTabAdmins.php");

if (!isset($_REQUEST['controleur'])) {
    $controleur = 'accueil';
} else {
    $controleur = $_REQUEST['controleur'];
}
$connexion = PdoBdSdis::getPdoBdSdis();
switch ($controleur) {
    case 'accueil': {
            include("vues/layout/v_layout_entete.php");
            include("vues/v_accueil.htm");
            break;
        }
    case 'informer' : {
            include("vues/layout/v_layout_entete.php");
            include("controleurs/c_informer.php");
            break;
        }
    case 'gererInscriptions' : {
            include("vues/layout/v_layout_entete.php");
            include("controleurs/c_gererInscriptions.php");
            break;
        }
    case 'gererAdministration' : {
            include("controleurs/c_gererAdmin.php");
            break;
        }
}
include("vues/layout/v_layout_pied.php");
