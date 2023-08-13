<?php
require('inc/framework.php');

// Initialisation des Sessions ($_SESSION)
session_name(SESSION_NAME);
session_start();

// Gestion des routes !

if(isset($_SESSION[SESSION_NAME]['id_user']) && !empty($_SESSION[SESSION_NAME]['id_user'])) {
    if (isset($_GET['page']) && isset($page[$_GET['page']])) {
        // La page demandé existe => on va pouvoir l'afficher !
        $url_php = $page[$_GET['page']];
    } else {
        // Forcer l'affichage de la page d'accueil
        $url_php = $page['home'];
    }
} else {
    // On force le login !
    $url_php = $page['login'];
}

// Gestion de la procedure
$url_php_proc = str_replace('.php', '_proc.php', $url_php);
if (is_file($url_php_proc)) {
    include $url_php_proc;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/interface.css">
    <link rel="stylesheet" type="text/css" href="css/shop.css"/>
    <title>
        <?php
        $url_php_title = str_replace('.php', '_title.php', $url_php);
        if (is_file($url_php_title)) {
            include $url_php_title;
        } else {
            echo "Formation IFR | Accueil";
        }
        ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <?php
    $url_php_head = str_replace('.php', '_head.php', $url_php);
    ?>
</head>
    <?php
        include $url_php;
    ?>
    <script>
        // Navbar Sticky Scroll
        window.addEventListener("scroll", function() {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 20);
        })
        const dropdown = document.querySelector(".shopDropdown");
        const btnDropdown = document.querySelector(".shopDropdown .shop");
        const closeBtnDropdown = document.querySelector(".shopDropdown .close");

        btnDropdown.addEventListener("click", () => {
            dropdown.classList.toggle("active");
        })
        closeBtnDropdown.addEventListener("click", () => {
            if (dropdown.classList.contains("active")) {
                dropdown.classList.remove("active");
            }
        })
    </script>
    <script src="ajax/ajaxForm.js"></script>

</html>