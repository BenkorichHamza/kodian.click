<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/politique', function () {
    return """<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Confidentialité - Kodian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1, h2 {
            color: #333;
        }
        .container {
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Politique de Confidentialité de Kodian</h1>
    <p><strong>Dernière mise à jour :</strong> [Date]</p>

    <h2>1. Introduction</h2>
    <p>Bienvenue sur Kodian ! Votre confidentialité est essentielle pour nous. Cette politique explique comment nous collectons, utilisons et protégeons vos informations personnelles lorsque vous utilisez notre application.</p>

    <h2>2. Informations Collectées</h2>
    <p>Nous pouvons collecter les types de données suivants :</p>
    <ul>
        <li><strong>Données personnelles :</strong> Nom, adresse, numéro de téléphone, e-mail.</li>
        <li><strong>Données de localisation :</strong> Pour assurer la livraison à votre adresse exacte.</li>
        <li><strong>Données de paiement :</strong> Informations de transaction (nous ne stockons pas vos détails bancaires).</li>
        <li><strong>Données d’utilisation :</strong> Interaction avec l’application pour améliorer nos services.</li>
    </ul>

    <h2>3. Utilisation des Données</h2>
    <p>Vos informations sont utilisées pour :</p>
    <ul>
        <li>Traiter et livrer vos commandes.</li>
        <li>Améliorer l’expérience utilisateur.</li>
        <li>Assurer la sécurité et prévenir les fraudes.</li>
        <li>Respecter nos obligations légales.</li>
    </ul>

    <h2>4. Partage des Données</h2>
    <p>Nous ne partageons vos informations qu’avec :</p>
    <ul>
        <li>Nos partenaires de livraison.</li>
        <li>Les prestataires de services de paiement.</li>
        <li>Les autorités si la loi l’exige.</li>
    </ul>

    <h2>5. Sécurité des Données</h2>
    <p>Nous mettons en place des mesures de sécurité pour protéger vos informations contre les accès non autorisés.</p>

    <h2>6. Vos Droits</h2>
    <p>Vous avez le droit de :</p>
    <ul>
        <li>Accéder, modifier ou supprimer vos données.</li>
        <li>Refuser certains traitements de vos données.</li>
    </ul>

    <h2>7. Contact</h2>
    <p>Pour toute question concernant votre confidentialité, contactez-nous à <strong>[votre email ou support client]</strong>.</p>
</div>

</body>
</html>
""";
});

require __DIR__.'/auth.php';
