<?php
// On démarre uen session
session_start();

// On inclut le fichier du dispatcheur
require 'controleur/dispatcheur.php';

// On instancie un dispatcheur
$dispatcheur = new Dispatcheur();

// On demande au dispatcheur de redirriger les données vers le contrôleur adéquat
$dispatcheur->dispatcherRequete();
