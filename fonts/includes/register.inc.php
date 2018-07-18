<?php
header ('Content-type:text/html; charset=utf-8');
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['Nomuser'], $_POST['p'])){
    // Nettoyez et validez les données transmises au script
    $Nomuser = filter_input(INPUT_POST, 'Nomuser', FILTER_SANITIZE_STRING);
    //$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    //$email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($Nomuser, FILTER_VALIDATE_REGEXP)) {
        // L’adresse email n’est pas valide
        $error_msg .= '<p class="error">nom user pas valide</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // Le mot de passe hashé ne doit pas dépasser les 128 caractères
        // Si ce n’est aps le cas, quelque chose de vraiment bizarre s’est produit
        $error_msg .= '<p class="error">Mot de passe invalide.</p>';
    }
 
    // La forme du nom d’utilisateur et du mot de passe a été vérifiée côté client
    // Cela devrait suffire, car personne ne tire avantage
    // à briser ce genre de règles.
    //
 
    $prep_stmt = "SELECT RefEmploye FROM employes WHERE Nomuser = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $Nomuser);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Il y a déjà un utilisateur avec ce nom-là
            $error_msg .= '<p class="error">Il existe déjà un utilisateur avec le même nom.</p>';
        }
    } else {
        $error_msg .= '<p class="error">Erreur de base de données</p>';
    }
 
    // CE QUE VOUS DEVEZ FAIRE: 
    // Nous devons aussi penser à la situation où l’utilisateur n’a pas
    // le droit de s’enregistrer, en vérifiant quel type d’utilisateur essaye de
    // s’enregistrer.
 
    /*if (empty($error_msg)) {
        // Crée un salt au hasard
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Crée le mot de passe en se servant du salt généré ci-dessus 
        $password = hash('sha512', $password . $random_salt);
 
        // Enregistre le nouvel utilisateur dans la base de données
        if ($insert_stmt = $mysqli->prepare("INSERT INTO employes (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Exécute la déclaration.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }*/
}