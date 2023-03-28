<!-- partie affichage HTML -->

    <div class="w-50 mx-auto mt-5 p-3 bg-body rounded shadow-lg">
        <h1 class="text-center .w-50 mt-4 mb-4 ">Inscription</h1>
        <form action="#" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
            <div class="mb-3">
                <label for="nom_utilisateur" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur">
            </div>
            <div class="mb-3">
                <label for="prenom_utilisateur" class="form-label">Prénom :</label>
                <input type="text" class="form-control" id="prenom_utilisateur" name="prenom_utilisateur">
            </div>
            <div class="mb-3">
                <label for="mail_utilisateur" class="form-label">Adresse mail :</label>
                <input type="email" class="form-control" id="mail_utilisateur" name="mail_utilisateur">
            </div>
            <div class="mb-3">
                <label for="password_utilisateur" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" id="password_utilisateur" name="password_utilisateur">
            </div>
            <div class="mb-3">
                <label for="image_utilisateur" class="form-label">Image de profil :</label>
                <input type="file" class="form-control" id="image_utilisateur" name="image_utilisateur">
            </div>
            <div class="text-center mt-5 mb-5"><button type="submit" class="btn btn-primary shadow-lg" name="submit_register">S'inscrire</button></div>
        </form>
    </div>
    <?php echo $message ?>
    <script src="../../Public/asset/script/script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>

<!-- partie gestion des messages d'erreur-->
<?php
    // if (isset($_GET['error'])) { //essayer de faire un switch
    //     if ($_GET['error'] == 0) {
    //         echo '<br><div class="alert alert-success w-50 mx-auto mt-3 text-center" role="alert">Votre compte a bien été créé</div>';
    //     }
    //     if ($_GET['error'] == 1) {
    //         echo '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">L\'adresse mail saisie est déjà utilisée par un autre compte</div>';
    //     }
    //     if ($_GET['error'] == 2) {
    //         echo '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">La taille de l\'image ne doit pas dépassée 100ko.</div>';
    //     }
    //     if ($_GET['error'] == 3) {
    //         echo '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Le format de l\'image n\'est pas correct. Les formats acceptées sont .jpg, .jpeg et .png.</div>';
    //     }
    //     if ($_GET['error'] == 4) {
    //         echo '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Veuillez compléter tous les champs du formulaire.</div>';
    //     }
    //     if ($_GET['error'] == 5) {
    //         echo '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Format de l\'adresse mail incorrect.</div>';
    //     }
    //     if ($_GET['error'] == 6) {
    //         echo '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Format du lien de l\'image incorrect.</div>';
    //     }
    // }
?>