<?php
require('inc/framework.php');

// Listing d'une table
    // => Lister les images dans la table t_photo

    // Etape 1 : Creation de la requete SQL
    $sql = "SELECT ";
    $sql.= " p.photographie AS photo,";
    $sql.= " p.titre AS titre,";
    $sql.= " p.description AS description,";
    $sql.= " CONCAT(u.prenom, ' ' , u.nom) AS utilisateur";
    $sql.= " FROM t_photo p";
    $sql.= " LEFT JOIN t_user u ON u.id=p.fk_user";

    // Pour afficher la requete directement
    // echo $sql;
    // exit();

    // Vérification si retour d'un formulaire
    if( isset($_POST['search']) && !empty($_POST['search']) ){
        // Si je suis ici => Il y a une recherche
        $sql.= " WHERE p.titre LIKE '%".$_POST['search']."%'";
        $sql.= " OR p.description LIKE '%".$_POST['search']."%'";
        $sql.= " OR CONCAT(u.prenom, ' ' , u.nom) LIKE '%".$_POST['search']."%'";
    }

    // Etape 2 : Execution de la requete sur le serveur de BDD
    $rs = mysqli_query($link,$sql);

    // Préparation du retour
    $html = '<div class="gridContainer">';

    // Etape 3 : Test du retour de la requete
    if($rs && mysqli_num_rows($rs)){
        // Si je suis ici => Tout va bien ! la requete est correcte et il y a au moins un enregistrement
        // Etape 4 : Je parcours les enregistrements de ma requete
        while( $data = mysqli_fetch_assoc($rs) ){
            $html.= '<div class="gridItem">';
            $html.= '    <img src="images/'.$data['photo'].'" />';
            $html.= '    <div class="overlay"></div>';
            $html.= '    <div class="bodyContent">';
            $html.=     '    <div class="title"><h2>'.$data['titre'].'</h2></div>';
            $html.=     '    <div class="description"><p>'.$data['description'].'</p></div>';
            $html.=     '    <div class="auteur"><p>Par: <a>'.$data['utilisateur'].'</a></p></div>';
            $html.= '   </div>';
            $html.= '</div>';
        }
    }
    $html.= '</div>';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formation IFR</title>
    <link rel="stylesheet" href="css/interface.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<header>
        <nav>
            <div class="logo">
                <p>Sql intro</p>
            </div>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="upload.php">Upload</a></li>
            </ul>
            <div class="groupBtn">
                <div class="search">
                    <form action="index.php" method="post">
                        <div class="formField">
                          <input type="text" name="search" placeholder="Rechercher" />  
                        </div>
                        <button><i class="bx bx-search"></i></button>
                    </form>
                </div>
                <div class="user">
                <button class="login">
                    <a href="login.php">
                        <i class='bx bx-log-in'></i>
                        <span>Connexion</span>
                    </a>
                </button>
            </div>
            </div>
            
        </nav>
        <main>
                <?php
                 echo $html;
                ?>
        </main>
    </header>
</body>
</html>