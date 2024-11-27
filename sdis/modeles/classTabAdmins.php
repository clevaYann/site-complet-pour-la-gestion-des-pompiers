<?php

/**
 * \file      classTabAdmins.php
 * \author    BTS SN IR
 * \version   1.0
 * \date      décembre 2017
 * \brief     Permet l'affichage dynamique dans  un tableau des informaitions sur les administrateurs.
 */
class TabAdmins extends PdoBdSdis {

    /**
     * \brief A
     * \details Fonction statique qui permet d'afficher la liste de tous les admins par odre acendant d'Id dans le fichier HTML v_gestion_admins
     */
    public static function getListeAdmin() {
        $ordresql = 'SELECT * FROM admin ORDER BY id ASC';
        $resRequete = self::$monPdo->query($ordresql);
        $resAllAdmins = $resRequete->fetchAll(PDO::FETCH_ASSOC);
        return $resAllAdmins;
    }

}
