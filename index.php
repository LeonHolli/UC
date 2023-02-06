<style>
<?php include 'css/login.css'; ?>
</style>

<!DOCTYPE html>
<html lang="de">
<img class="image" src="login.jpg" alt="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Termin Kalender</title>
</head>
<body>
    <?php 
        if(isset($_POST['login'])){
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['pass'] = $_POST['passwort'];
            if(trim($_SESSION['user'])){
                header("Location: kalender.php");
                die();
            }
            else{?>
                <form method="POST">
                    <div class="container">
                        <h3>Fehler beim Login</h3>
                        <h2>Login - Termin Kalender</h2>
                        <p class="left">User</p>
                        <input class="box" type="text" name="user">
                        <p class="left">Passwort</p>
                        <input class="box" type="text" name="passwort">
                        <p><input class="button" type="submit" name="login" value="->"></p>    
                    </div>
                </form>
            <?php   
            }
            
        }
        else{?>
            <form method="POST">
                <div class="container">
                    <h2>Login - Termin Kalender</h2>
                    <p class="left">User</p>
                    <input class="box" type="text" name="user">
                    <p class="left">Passwort</p>
                    <input class="box" type="text" name="passwort">
                    <p><input class="button" type="submit" name="login" value="->"></p>    
                </div>
            </form>
        <?php   
        }
        ?>

    
</body>
</html>