<?php

/**
 * Created by Manu
 * Date:
 * Time:
 */
namespace fr\gilman\nj;

class Cli extends Controller {

    public static function genererPartie()
    {
        $partie = new Partie();
        $partie->setNom('manux');
        $partie->setLargeur(30);
        $partie->setHauteur(20);
        $partie->setNbGermes(rand(3,5));
        $partie->setAltMin(10);
        $partie->setAltMax(16);
        $partie->setCoefGaussMinGermes(1);
        $partie->setCoefGaussMaxGermes(12);
        $partie->setRandGermes(mt_rand(1,1000));
        $partie->setNbGermesForet(rand(1,4));
        $partie->setCoefGaussMinGermesForet(1);
        $partie->setCoefGaussMaxGermesForet(12);
        $partie->setRandForet(mt_rand(1,1000));
        $partie->setSeedFromValues();
        $partie->setOuverte(1);
        $partie->save();
        $partie->genererHexas();
    }
}