<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodian - Livraison à Domicile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Mode sombre automatique */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #121212;
                color: white;
            }
        }

        /* Style de la page */
        .container {
            text-align: center;
            margin-top: 10%;
        }

        .logo {
            width: 150px; /* Ajuste la taille du logo */
        }

        .btn-green {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 18px;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-green:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('images/fulllogo.png') }}" alt="Kodian" width="200">
        </div>
        <h1 class="mt-4">Bienvenue sur Kodian</h1>
        <p class="lead">L'application de livraison à domicile rapide et fiable en Algérie.</p>
        <a href="#" class="btn-green">Découvrir l'application</a>
    </div>

</body>
</html>
