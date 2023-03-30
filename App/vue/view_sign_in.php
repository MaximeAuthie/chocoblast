<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Public/asset/style/main.css">
        <script src="./App/Public/asset/script/script.js" defer></script>
        <title>Inscription</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <title>Chocoblaster 9000</title>
        <style>
            #background {
                background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("./Public/asset/image/choco.jpg");;
                -webkit-backdrop-filter: blur(5px); /* assure la compatibilité avec safari */
                backdrop-filter: blur(5px);
                height: 100vh;
            }
        </style>
    </head>

    <body id="background" class="bg-image" >
        <header class="sticky-top bg-body-tertiary ">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="w-75 mx-auto container-fluid">
                    <img src="./Public/asset/image/choco.png" alt="Logo" width="40" height="32" class="d-inline-block align-text-top">
                    <a class="navbar-brand ps-2" href="#">Chocoblaster 9000</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarNav">
                        <ul class="navbar-nav text-center">
                            <li class="nav-item">
                                <a class="nav-link" href="accueil">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="chocoblast">chocoblast</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="connexion">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="inscription">Inscription</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="w-50 mx-auto mt-5 p-3 bg-body rounded shadow-lg">
                <h1 class="text-center .w-50 mt-4 mb-4 ">Connexion</h1>
                <form action="#" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
                    <div class="mb-3">
                        <label for="mail_utilisateur" class="form-label">Adresse mail du compte :</label>
                        <input type="email" class="form-control" id="mail_utilisateur" name="mail_utilisateur">
                    </div>
                    <div class="mb-3">
                        <label for="password_utilisateur" class="form-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="password_utilisateur" name="password_utilisateur">
                    </div>
                    <div class="text-center mt-5 mb-5"><button type="submit" class="btn btn-primary shadow-lg" name="submit_sign_in">Se connecter</button></div>
                </form>
        </div>
        <?php echo $message ?>
        <script src="../../Public/asset/script/script.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>

</html>