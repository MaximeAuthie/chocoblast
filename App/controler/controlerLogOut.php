<?php
    session_start();
    session_destroy();
    $deconnexion = '';
    
    $navbar = ' <li class="nav-item">
                    <a class="nav-link" href="accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="chocoblast">chocoblast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inscription">Inscription</a>
                </li>';

    include './App/vue/header.php';
    include './App/vue/view_log_out.php';
?>