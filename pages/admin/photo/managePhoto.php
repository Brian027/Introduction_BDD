<?php
require('../../inc/param.php');
require('../../class/data.class.php');
$bdd = new Data();

// UPDATE USER INFORMATIONS
if (isset($_POST) && !empty($_POST)) {
    // On revient d'un formulaire

    // Préparation des informations récuperées du formulaire
    $h = array();

    $h['titre'] = $_POST['titre_photo'];
    $h['description'] = $_POST['description_photo'];

    // Gestion de l'avatar
    if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['photo']['name'])) {
        // Generation d'un nom unique
        $tab_name = explode('.', $_FILES['photo']['name']);
        $unique_name = uniqid('img_') . '.' . $tab_name[1];

        // Préparation de l'upload
        $uploaddir = '../../images/';
        $uploadfile = $uploaddir . $unique_name;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
            $h['photographie'] = $unique_name;
        }
    }

    // Test pour savoir si on ajoute ou on modifie
    if ($_POST['id_photo'] > 0) {
        // Update de BDD
        $id_photo = $_POST['id_photo'];

        // execution de la requete
        $bdd->sql_update('t_photo', $id_photo, $h);
    } else {
        // execution de la requete
        $id_photo = $bdd->sql_insert('t_photo', $h);
    }
    header("location: ../../index.php?page=listing_photo");
}

// Verification pour Ajout / Modification
if (isset($_GET['id_photo']) && !empty($_GET['id_photo'])) {
    // Modification
    $id_photo = $_GET['id_photo'];
    $photo = $bdd->build_r_from_id('t_photo', $id_photo);
} else {
    // On est en creation
    $id_photo = 0;
    $photo = array();
    $photo['titre'] = '';
    $photo['description'] = '';
    $photo['photographie'] = '';
}


// Formulaire de modification
// Mise en forme du formulaire
$html = '<div class="blurBG"></div>';
$html .= '<div class="close" onclick="closeForm()"><i class="bx bx-x"></i></div>';
$html .= '<h2>Modifier ' . $photo['titre'] . '</h2>';
$html .= '<form action="pages/photo/managePhoto.php" method="POST" enctype="multipart/form-data">';
$html .= '<input type="hidden" name="id_photo" value="' . $id_photo . '" />';
$html .= '<div class="formField">';
$html .= '<label for="nom">Nom</label>';
$html .= '<input type="text" name="titre_photo" id="nom" placeholder="Nom" value="' . $photo['titre'] . '" />';
$html .= '</div>';
$html .= '<div class="formField">';
$html .= '<label for="description">Description</label>';
$html .= '<input type="text" name="description_photo" id="description" placeholder="Description" value="' . $photo['description'] . '" />';
$html .= '</div>';
$html .= '<div class="formField">';
$html .= '<label for="photo">Photo</label>';
$html .= '<input type="file" name="photo" id="photo" />';
$html .= '</div>';
// FORM SUBMIT
$html .= '<div class="formField">';
$html .= '<button>Mettre a jour</button>';
$html .= '</div>';
$html .= '</form>';

echo $html;
?>