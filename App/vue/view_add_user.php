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
