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
        <h1>PHow to delete my account</h1>
        <ol>
            <li>Go to your profile page.</li>
            <li>Scroll to the bottom and click on the "Delete My Account" button.</li>
            <li>You will be redirected to the user deletion page.</li>
            <li>Press the "Delete My Account" button again.</li>
            <li>Confirm by selecting "Yes" to permanently delete your account.</li>
        </ol>


</body>
</html>
