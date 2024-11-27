<?php

/**
 * \file      classTabSapeurs.php
 * \author    BTS SN IR
 * \version   1.0
 * \date      décembre 2017
 * \brief     Permet l'affichage dynamique dans  un tableau des informaitions sur les postulants sapeurs.
 * \details   Actions sur ou depuis les TABLEAUX getion sapeurs
 */
class TabSapeurs extends PdoBdSdis {
    /********************************************
     * Tableau listing des postulants sapeurs
     ********************************************/

    /**
     * \brief Fonction statique qui permet d'afficher la liste de tous les postulants sapeurs
     * \details Affichage odre acendant d'Id dans le fichier HTML v_gestion_sapeurs
     */
    public static function getListeSapeur() {
        $ordresql = 'SELECT * FROM inscriptions ORDER BY id ASC';
        $resRequete = self::$monPdo->query($ordresql);
        $resAllSapeurs = $resRequete->fetchAll(PDO::FETCH_ASSOC);
        return $resAllSapeurs;
    }

    /**
     * \brief Fonction statique qui permet d'afficher la liste de tous les postulants sapeurs qui possèdent le brevet dans v_gestion_sapeurs
     * \details (depuis le lien Brevet du tableau)
     */
    public static function getListeBrevetSapeur() {
        $ordresql = "SELECT * FROM inscriptions WHERE Brevet='oui'";
        $resRequete = self::$monPdo->query($ordresql);
        $resBrevetSapeurs = $resRequete->fetchAll(PDO::FETCH_ASSOC);
        return $resBrevetSapeurs;
    }

    /**
     * \brief Fonction statique qui permet de trier la liste des postulants sapeurs en fonction de leur age ascendant dans v_gestion_sapeurs
     * \details (depuis le lien Age du tableau)
     */
    public static function getListeAgeSapeur() {
        $ordresql = "SELECT * FROM inscriptions ORDER BY Age ASC";
        $resRequete = self::$monPdo->query($ordresql);
        $resAgeSapeurs = $resRequete->fetchAll(PDO::FETCH_ASSOC);
        return $resAgeSapeurs;
    }

    /**
     * \brief  Fonction statique qui permet de supprimer un postulant sapeur
     * \details (depuis le bouton SUPPR du tableau v_gestion_sapeurs)
     * \param   $Lid    id du postulant sapeur à supprimer.
     */
    public static function DelSapeur($Lid) {
        $req = "DELETE FROM inscriptions WHERE id= $Lid";
        $resDelSapeurs = self::$monPdo->exec($req);
        return $resDelSapeurs;
    }

    /**
     * \brief  Fonction statique qui permet de mettre à jour les informations d'un postulant sapeur
     * \details (depuis le bouton MAJ du tableau v_gestion_sapeurs)
     */
    public static function UpdateSapeur($Lid, $lEmail, $lAge, $leBrevet) {
        $req = "UPDATE inscriptions SET Email='" . $lEmail . "', Age='" . $lAge . "', Brevet='" . $leBrevet . "' WHERE id= $Lid";
        $resUpdateSapeurs = self::$monPdo->exec($req);
        return $resUpdateSapeurs;
    }

    /****************************************************************
     * Second TABLEAUX information sapeurs (tranches d'âge, brevet)
     ****************************************************************/

    /**
     * \brief  Fonction statique qui Permet de compter le nombre de postulants sapeurs
     * \return int le nombre 
     */
    public static function getNbSapeurs() {
        $ordresql = 'SELECT count(*) as nbSapeurs FROM inscriptions';
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeurs;
    }

    /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs dont l'âge est compris entre 16 et 18 ans
     * \return int le nombre
     */
    public static function getSapeursSeize() {
        $ordresql = "SELECT count(*) as nbSapeursSeize FROM inscriptions WHERE Age='16-18'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursSeize;
    }

     /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs dont l'âge est compris entre 18 et 25 ans
     * \return int le nombre
     */
    public static function getSapeursDixHuit() {
        $ordresql = "SELECT count(*) as nbSapeursDixHuit FROM inscriptions WHERE Age='18-25'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursDixHuit;
    }

     /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs dont l'âge est compris entre 25 et 40 ans
     * \return int le nombre
     */
    public static function getSapeursVingtCinq() {
        $ordresql = "SELECT count(*) as nbSapeursVingtCinq FROM inscriptions WHERE Age='25-40'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursVingtCinq;
    }

     /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs dont l'âge est supérieur à 40 ans
     * \return int le nombre
     */
    public static function getSapeursQuaranteSup() {
        $ordresql = "SELECT count(*) as nbSapeursQuaranteSup FROM inscriptions WHERE Age='>40'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursQuaranteSup;
    }

    /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs dont l'âge est compris entre 16 et 18 ans et possédnat le breve
     * \return int le nombre
     */
    public static function getSapeursSeizeBrevet() {
        $ordresql = "SELECT count(*) as nbSapeursSeizeBrevet FROM inscriptions WHERE Age='16-18' AND Brevet='oui'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursSeizeBrevet;
    }

     /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs dont l'âge est compris entre 18 et 25 ans et possédnat le breve
     * \return int le nombre
     */
    public static function getSapeursDixHuitBrevet() {
        $ordresql = "SELECT count(*) as nbSapeursDixHuitBrevet FROM inscriptions WHERE Age='18-25'AND Brevet='oui'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursDixHuitBrevet;
    }

     /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs dont l'âge est compris entre 25 et 40 ans et possédnat le breve
     * \return int le nombre
     */
    public static function getSapeursVingtCinqBrevet() {
        $ordresql = "SELECT count(*) as nbSapeursVingtCinqBrevet FROM inscriptions WHERE Age='25-40'AND Brevet='oui'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursVingtCinqBrevet;
    }

     /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs dont l'âge est supérieur à 40 ans et possédnat le brevet
     * \return int le nombre
     */
    public static function getSapeursQuaranteSupBrevet() {
        $ordresql = "SELECT count(*) as nbSapeursQuaranteSupBrevet FROM inscriptions WHERE Age='>40'AND Brevet='oui'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursQuaranteSupBrevet;
    }

    /**
     * \brief  Fonction statique qui permet de compter le nombre de postulants sapeurs possédant le brevet de secouriste
     */
    public static function getNbSapeursBrevet() {
        $ordresql = "SELECT count(*) as nbSapeursBrevet FROM inscriptions WHERE Brevet='oui'";
        $resRequete = self::$monPdo->query($ordresql)->fetch();
        return $resRequete->nbSapeursBrevet;
    }

}
