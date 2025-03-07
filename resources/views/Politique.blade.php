<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon.png') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Confidentialité - Kodian</title>
    <style>
        :root {
            --primary-color: #27ae60; /* Vert */
            --background-light: #f9f9f9;
            --text-light: #333;
            --container-light: #ffffff;
            --background-dark: #121212;
            --text-dark: #f1f1f1;
            --container-dark: #1e1e1e;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;

            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 20px;
            background-color: var(--background-light);
            color: var(--text-light);
            transition: background-color 0.3s, color 0.3s;
        }

        .container {

            max-width: 800px;
            background: var(--container-light);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: background 0.3s;
        }

        h1, h2 {
            color: var(--primary-color);
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: var(--background-dark);
                color: var(--text-dark);
            }
            .container {
                background: var(--container-dark);
                box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('images/fulllogo.png') }}" alt="Kodian" width="200">
        </div>
        <h1>Politique de Confidentialité de Kodian</h1>
        <p><strong>Dernière mise à jour :</strong> 07/02/2025</p>
        <h2>1. Introduction</h2>
        <p>Bienvenue sur <strong>Kodian</strong> ! Votre confidentialité est essentielle pour nous. Cette politique explique comment nous collectons, utilisons et protégeons vos informations personnelles lorsque vous utilisez notre application, qui est exclusivement disponible en <strong>Algérie</strong>.</p>

        <h2>2. Informations Collectées</h2>
        <p>Nous collectons uniquement les données nécessaires pour assurer le bon fonctionnement de notre service de livraison :</p>
        <ul>
            <li><strong>Données personnelles :</strong> Nom, adresse, numéro de téléphone, e-mail.</li>
            <li><strong>Données de localisation :</strong> Pour assurer une livraison précise.</li>
            <li><strong>Données d’utilisation :</strong> Statistiques d’usage de l’application pour l’amélioration du service.</li>
        </ul>

        <h2>3. Paiement</h2>
        <p><strong>Il n'y a pas de paiement en ligne.</strong> Toutes les commandes passées via Kodian sont réglées en espèces à la livraison.</p>

        <h2>4. Utilisation des Données</h2>
        <p>Vos informations sont utilisées exclusivement pour :</p>
        <ul>
            <li>Traiter et livrer vos commandes en Algérie.</li>
            <li>Améliorer l’expérience utilisateur.</li>
            <li>Garantir la sécurité des transactions.</li>
            <li>Respecter les obligations légales en vigueur en Algérie.</li>
        </ul>

        <h2>5. Partage des Données</h2>
        <p>Nous ne partageons vos informations qu’avec :</p>
        <ul>
            <li>Nos partenaires de livraison opérant en Algérie.</li>
            <li>Les autorités locales si requis par la loi algérienne.</li>
        </ul>

        <h2>6. Sécurité des Données</h2>
        <p>Nous mettons en place des mesures strictes pour protéger vos informations contre tout accès non autorisé.</p>

        <h2>7. Vos Droits</h2>
        <p>Conformément à la réglementation algérienne, vous avez le droit de :</p>
        <ul>
            <li>Accéder, modifier ou supprimer vos données.</li>
            <li>Refuser certains traitements de vos données.</li>
        </ul>

        <h2>8. Contact</h2>
        <p>Pour toute question ou demande concernant votre confidentialité, contactez-nous à <a href="mailto:kodianapp@gmail.com">kodianapp@gmail.com</a>.</p>
    </div>

</body>
</html>
