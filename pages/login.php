<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>salut - Connexion</title>
    <style>
     
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            width: 350px;
            padding: 40px 40px 30px;
            background: #fff;
            border: 1px solid #dbdbdb;
            text-align: center;
            margin: 0 40px;
        }

       
        .salut-logo {
            font-family: 'Billabong', cursive;
            font-size: 44px;
            margin: 10px 0 30px;
            color: #262626;
            font-weight: normal;
        }

        .form-group {
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 9px 8px;
            font-size: 12px;
            border: 1px solid #dbdbdb;
            border-radius: 3px;
            background: #fafafa;
            color: #262626;
            margin-bottom: 6px;
        }

        input[type="submit"] {
            width: 100%;
            background: #0095f6;
            color: white;
            font-weight: 600;
            padding: 7px;
            border: none;
            border-radius: 8px;
            margin: 14px 0;
            cursor: pointer;
        }

        .separator {
            color: #8e8e8e;
            font-weight: 600;
            font-size: 13px;
            margin: 18px 0;
            position: relative;
        }

        .separator::before,
        .separator::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 43%;
            height: 1px;
            background: #dbdbdb;
        }

        .separator::before { left: 0; }
        .separator::after { right: 0; }

        .forgot-password {
            color: #00376b;
            font-size: 12px;
            text-decoration: none;
            display: block;
            margin: 15px 0;
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
        <div class="salut-logo">Salut</div>
        
        <form action="traitement/traitement_login.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Adresse e-mail" required>
            </div>
            <div class="form-group">
                <input type="password" name="mdp" placeholder="Mot de passe" required>
            </div>
            <input type="submit" value="Se connecter">
        </form>

       

        <a href="#" class="forgot-password">Mot de passe oublié ?</a>

      
        <div class="signup-link">
            Vous n'avez pas de compte ? 
            <a href="inscription.php" style="color: #0095f6; text-decoration: none; font-weight: 600;">Inscrivez-vous</a>
        </div>
    </div>
</body>

</html>