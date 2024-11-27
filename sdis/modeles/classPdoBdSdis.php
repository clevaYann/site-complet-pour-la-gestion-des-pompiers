<?php

/**
 * \file      classPdoBdSdis.php
 * \author    TS SN IR
 * \version   1.0
 * \date      décembre 2017
 * \brief     Inscription et gestion des postulant à la formation de sapeur.
 * \details   Classe d'accés aux données. Permet les inscriptions, ajouts, mofdication des postulants sapeurs ou des administrateurs.
 *            Utilise les services de la classe PDO
 */
class PdoBdSdis {

    protected static $monPdo;
    protected static $monPdoBdSdis = null;

    /**
     * \author    A. M.
     * \brief     Constructeur privé, crée l'instance de PDO qui sera sollicitée pour toutes les méthodes de la classe
     * \details   Utilisation du design Patter Singleton
     */
    private function __construct() {
        self::$monPdo = new PDO('mysql:host=localhost;dbname=sdis', 'root', 'root');
        self::$monPdo->query("SET CHARACTER SET utf8");
        self::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$monPdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function _destruct() {
        self::$monPdo = null;
        self::$monPdoBdSdis = null;
    }

    /**
     * \brief Fonction statique qui cree l'unique instance de la classe
     */
    public static function getPdoBdSdis() {
        if (self::$monPdoBdSdis == null) {
            self::$monPdoBdSdis = new PdoBdSdis();
        }
        return self::$monPdoBdSdis;
    }

    /*     * *****************************************************************************************************
     * \brief Inscription, Modification, Ajout de postulant Sapeur
     * \details Actions depuis les formulaires v_formAdmin.htm, v_formInscriptions.htm et v_formAjoutSapeur
     * ****************************************************************************************************** */

    /**
     * \brief Fonction statique qui vérifie que l'email du postulant sapeur n'existe pas déjà en base de données
     * \param   $lEmail         string Adresse Email entrée par le postulant Sapeur.
     * \return  $resVerifEmail  Booléen    True ou False selon que le mail est déjà en BDD ou pas.
     */
    public static function getLEmail($lEmail) {
        $ordresql = "select * from inscriptions  where Email='" . $lEmail . "'";
        $resRequete = self::$monPdo->query($ordresql);
        $resVerifEmail = $resRequete->fetch(PDO::FETCH_ASSOC);
        return $resVerifEmail;
    }

    /**
     * \brief   Fonction statique qui permet d'inscrire le postulant sapeur
     * \details Inscription si le formulaire est bien renseigné par un posutulant ou par l'Admin depuis le bouton ajout de v_gestion_sapeurs.
     * \param   $lEmail      Adresse Email entrée par le postulant Sapeur.
     * \return  String       contenant l'Email (exemple "sap1@info.eh")
     * \param   $lAge        Tranche d'âge du postulant Sapeur.
     * \return  String       contenant la tranche d'âge (exemple "16 - 18")
     * \param   $leBrevet    Le postulant Sapeur possède le Brevet de Secouriste ou pas.
     * \return  String       contenant "oui" ou "non".
     */
    public static function insererVolontaire($lEmail, $lAge, $leBrevet) {
        $req = "INSERT into inscriptions(Email,Age,Brevet) VALUES('" . $lEmail . "','" . $lAge . "','" . $leBrevet . "')";
        //echo $req;
        $res = self::$monPdo->exec($req);
        return $res;
    }

    /**
     * Fonction statique qui permet de d'afficher les infosmations du postulant Sapeur à metrre à jour.
     * Fonction statique qui permet de péremplir le champ mail du formulaire de Mise à Jour
     * (les autres éléments sont des choix boutons ou liste)
     * \param   $Lid     Id du postulant sapeur dont on veut modifier les informations.
     * \return  String   adresse Email de l'Id concerné.
     */
    public static function getSapeur($Lid) {
        $ordresql = "SELECT * FROM inscriptions WHERE id=$Lid";
        $resRequete = self::$monPdo->query($ordresql);
        $resSapeur = $resRequete->fetch(PDO::FETCH_ASSOC);
        return $resSapeur;
    }

    /**
     * \brief Fonction statique qui permet de mettre à jour les informations d'un postulant sapeur (depuis le bouton MAJ du tableau v_gestion_sapeurs).
     * \param   $Lid         Id du postulant sapeur dont on veut mettre à jour les informations.
     * \param   $lEmail      Adresse Email entrée par le postulant Sapeur ou modifié par l'administrateur.
     * \return  String       contenant l'Email (exemple "sap1@info.eh")
     * \param   $lAge        Tranche d'âge du postulant Sapeur ou modifié par l'administrateur.
     * \return  String       contenant la tranche d'âge (exemple "16 - 18") entrée par le postulant Sapeur ou modifié par l'administrateur.
     * \param   $leBrevet    Le postulant Sapeur possède le Brevet de Secouriste ou pas.
     * \return  String       contenant "oui" ou "non" entré par le postulant Sapeur ou modifié par l'administrateur.
     */
    public static function UpdateSapeur($Lid, $lEmail, $lAge, $leBrevet) {
        $req = "UPDATE inscriptions SET Email='" . $lEmail . "', Age='" . $lAge . "', Brevet='" . $leBrevet . "' WHERE id= $Lid";
        $resUpdateSapeurs = self::$monPdo->exec($req);
        return $resUpdateSapeurs;
    }

    /**
     * \brief Fonction statique qui recherche le nom d'utilisateur et mot de passe de l'Admin pour l'authentification
     * \param   $leUsername    string  Identifiant d'un administrateur.
     * \param   $lePassword    string  Mot de passe hashé d'un administrateur.
     * \return  Booléen        True ou False selon que le couple identifiant&mot de passe exact est bien présent en BDD ou pas.
     */
    public static function getLAdmin($leUsername, $lePassword) {
        $ordresql = "SELECT * FROM admin WHERE username='" . $leUsername . "' and password='" . ($lePassword) . "' ";
        $resRequete = self::$monPdo->query($ordresql);
        $resAuth = $resRequete->fetch(PDO::FETCH_ASSOC);
        return $resAuth;
    }

}
