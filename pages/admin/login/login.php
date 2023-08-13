<?php 
    $bdd = new Data();
    if(isset($_POST) && !empty($_POST)) {
        // Retour du formulaire
        // Recuperer les informations du formumlaire
        $login_user = $_POST['form_user'];
        $password_user = md5($_POST['form_password']);

        // 1 requete SQL avec les informations
        // Requete Solution 1 : SELECT * FROM t_user WHERE login=""
        // Requete Solution 2 : SELECT * FROM t_user WHERE login="" AND password="'.md5($_POST['form_password']).'"
        // Si tout se passe bien => Enregistrement en SESSION des informations
        $sql = 'SELECT * FROM t_user WHERE login="'.$login_user.'" AND password="'.($password_user).'"';
        $data_user = $bdd->getData($sql);
        if(!empty($data_user)) {
            // Enregistrement en Session
            $_SESSION[SESSION_NAME]['id_user'] = $data_user[0]['id'];
            $_SESSION[SESSION_NAME]['nom'] = $data_user[0]['nom'] . ' ' . $data_user[0]['prenom'];
            $_SESSION[SESSION_NAME]['avatar'] = $data_user[0]['avatar'];
            $_SESSION[SESSION_NAME]['langue'] = $data_user[0]['fk_langue'];
        }

        // Redirection page d'accueil
        header('Location: index.php');
    }

    // Mise en page du formulaire de connexion
    $html = '<div class="login-container">';
    $html .= '<div class="login-form">';
    $html .= '<div class="circle">';
    $html .= '<h1>Bienvenue</h1>';
    $html .= '<i class="bx bxs-user"></i>';
    $html .= '</div>';
    $html .= '<form action="index.php?page=login" method="post">';
    $html .= '<div class="form-group">';
    $html .= '<label for="form_user">Username</label>';
    $html .= '<input type="text" name="form_user" id="form_user" placeholder="Nom d\'utilisateur">';
    $html .= '</div>';
    $html .= '<div class="form-group">';
    $html .= '<label for="form_password">Mot de passe</label>';
    $html .= '<input type="password" name="form_password" id="form_password" placeholder="Mot de passe">';
    $html .= '</div>';
    $html .= '<div class="form-group">';
    $html .= '<button>Connexion</button>';
    $html .= '</div>';
    // Forgot password
    $html .= '<div class="password-forgot">';
    $html .= '<a href="forgot_password.php">Mot de passe oublié ?</a>';
    $html .= '</div>';
    $html .= '</form>';
    $html .= '</div>';
    $html .= '</div>';

    $page = new Page(false);
    $page->build_content($html);
    $page->show();
?>