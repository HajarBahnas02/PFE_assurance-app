<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-color: #007bff ;
        }

        h2 {
            color: #007bff;
        }

        p {
            margin-bottom: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }

        a:hover {
            background-color: white;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Réinitialisation de mot de passe</h2>
        <p>Bonjour</p>
        <p>Vous avez demandé une réinitialisation de mot de passe. Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe :</p>
        <p>
            <a href="{{ $resetUrl }}">Réinitialiser le mot de passe</a>
        </p>
        <p>Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email.</p>
        <footer>L'équipe Shahed</footer>
    </div>
</body>
</html>
