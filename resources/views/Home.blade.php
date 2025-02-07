<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodian - Livraison d'Épicerie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Mode Sombre Automatique */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #121212;
                color: white;
            }
            .btn-primary {
                background-color: #4CAF50;
                border-color: #4CAF50;
            }
            .card {
                background-color: #1E1E1E;
            }
        }

        .btn-green {
            background-color: #4CAF50;
            color: white;
        }

        .btn-green:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">Kodian</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Produits</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="text-center py-5">
        <div class="container">
            <h1 class="display-4">Livraison d'Épicerie Facile avec Kodian</h1>
            <p class="lead">Commandez vos produits frais et recevez-les à domicile en Algérie.</p>
            <a href="#" class="btn btn-green btn-lg"><i class="fas fa-shopping-cart"></i> Explorer</a>
        </div>
    </header>

    <section class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <i class="fas fa-truck fa-3x text-success"></i>
                    <h4 class="mt-3">Livraison Rapide</h4>
                    <p>Recevez vos courses en quelques heures seulement.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <i class="fas fa-apple-alt fa-3x text-success"></i>
                    <h4 class="mt-3">Produits Frais</h4>
                    <p>Nous sélectionnons les meilleurs produits pour vous.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <i class="fas fa-lock fa-3x text-success"></i>
                    <h4 class="mt-3">Paiement à la Livraison</h4>
                    <p>Paiement sécurisé lors de la réception de votre commande.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-4 bg-light">
        <p>© 2025 Kodian - Livraison d'Épicerie en Algérie</p>
        <a href="mailto:kodianapp@gmail.com" class="text-success">Contactez-nous</a> |
        <a href="https://kodianapp.com/privacy-policy" target="_blank" class="text-success">Politique de Confidentialité</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
