<?php
$bdd = new Data();

$sql  = " SELECT ";
$sql .= "    p.id AS id_produit, ";
$sql .= "    pt.titre AS titre, ";
$sql .= "    pt.description_courte AS description, ";
$sql .= "    (p.prixHT + (p.prixHT / 100 * t.value)) AS prixTTC, ";
$sql .= "    pr.reduction AS reduction,";
$sql .= "    GROUP_CONCAT(pi.nom_fichier SEPARATOR '#') AS fichier_image, ";
$sql .= "    (SELECT SUM(qte) FROM t_produit_stock WHERE fk_produit=p.id) AS qte ";
$sql .= "  FROM ";
$sql .= "    t_produit p ";
$sql .= "    LEFT JOIN t_produit_trad pt ON pt.fk_produit=p.id ";
$sql .= "    LEFT JOIN t_produit_image pi ON pi.fk_produit=p.id ";
$sql .= "    LEFT JOIN t_promotion pr ON pr.id=p.fk_promotion ";
$sql .= "    LEFT JOIN t_tva t ON t.id=p.fk_tva ";
$sql .= "    LEFT JOIN t_produit_rayon pra ON pra.fk_produit=p.id ";
$sql .= "  WHERE pt.fk_langue=1";
if(isset($_GET['id_rayon'])) {
    $sql .= " AND pra.fk_rayon=".$_GET['id_rayon'];
}
$sql .= "  GROUP BY p.id ";
$datas_produit = $bdd->getData($sql);

$sql = "SELECT r.id, rt.nom FROM t_rayon r LEFT JOIN t_rayon_trad rt ON rt.fk_rayon=r.id WHERE rt.fk_langue=1";
$datas_rayon = $bdd->getData($sql);
$link = array();
$html =  '<main class="shop">
                    <div class="titlePage">
                    <h1 class="titleProductHeader">Nos produits</h1>
                    </div>
                    <div class="containerGlobal">
                        <div class="sideBar">
                            <form action="#">
                                <div class="formField">
                                    <input type="search" name="search" id="searchInput" placeholder="Rechercher" />
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                                <div class="linkContainer">
                                    <div class="linkCategories">';
                                    if($datas_rayon){
                                        foreach ($datas_rayon as $data_rayon) {
                                            $link[] = '<a href="index.php?page=fo_home&id_rayon='.$data_rayon['id'].'">'.$data_rayon['nom'].'</a>';
                                        }
                                    }
$html .= implode($link);                     
$html  .=                   '</div>
                                </div>
                                <button type="button" class="allCategories">';
$html .=                                    $link[] = '<a href="index.php?page=fo_home">Tous</a>';
$html .=                '</button>
                        </form>
                    </div>';

 $html .=  '<div class="galleryProduct">';

 if($datas_produit){
    foreach($datas_produit as $data_produit){
        if(!empty($data_produit['fichier_image'])) {
            // On a une ou plusieurs images.. (au hazard si plusieurs)
            $tab_image = explode('#', $data_produit['fichier_image']);
            shuffle($tab_image);
            $image = 'images/produit/' . $tab_image[0];
        } else {
            // image par defaut => le produit n'a pas d'image...
            $image = 'images/interface/default_product.png';
        }
    $html .=        '<div class="productCard">
                                <div class="imgProduct">
                                    <img src="'.$image.'" alt="Image Asus Rog" />';
                                    if($data_produit['qte']>0) {
                                        $html .= '       <span>';
                                        $html .= '           En stock';
                                        $html .= '       </span>';
                                    } else {
                                        $html .= '       <span>';
                                        $html .= '           En rupture';
                                        $html .= '       </span>';
                                    }
    $html .=               '</div>
                                <div class="productContent">
                                    <div class="tagNote">
                                        <p>TechStore - Asus</p>
                                        <span><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                    <div class="productDescription">
                                        <h2 class="productTitle">PC Gamer Asus</h2>
                                        <p>
                                            Le PC Gamer ASUS ROG STRIX GT15 allie puissance, praticité et
                                            élégance au service du divertissement numérique. Facile à
                                            transporter, grâce à sa poignée intégrée, ce PC Gamer ASUS
                                            offre aussi l\'avantage d\'une mise à niveau simplifiée.
                                        </p>
                                        <span><img src="images/arrowtobracket.png" alt="image arrow bracket" />95
                                            Achats</span>
                                    </div>
                                    <div class="productPrice">
                                        <p>€1499</p>
                                    </div>
                                    <div class="callToAction">
                                        <button class="addToCard">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                        <button class="viewProduct">
                                            <a href="../detailsProduit/detailsProduit.html" target="_blank"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </button>
                                    </div>
                                </div>
                            </div>';
            }
}
$html .=        '</div>
                </div>
            </main>';
// if($datas_produit) {
//     foreach($datas_produit as $data_produit) {
//         $html.= '<div class="one_product">';

//         // Gestion image produit
//         if(!empty($data_produit['fichier_image'])) {
//             // On a une ou plusieurs images.. (au hazard si plusieurs)
//             $tab_image = explode('#', $data_produit['fichier_image']);
//             shuffle($tab_image);
//             $image = 'images/produit/' . $tab_image[0];
//         } else {
//             // image par defaut => le produit n'a pas d'image...
//             $image = 'images/interface/default_product.png';
//         }
//         $html.= '   <div class="product_image">';
//         $html.= '       <img src="'.$image.'" alt="'.$data_produit['titre'].'" />';
//         $html.= '   </div>';
//         $html.= '   <div class="product_information">';
//         $html.= '       <div class="product_link">';
//         $html.= '           <a href="index.php?page=fo_produit&id_produit='.$data_produit['id_produit'].'">';
//         $html.= '               Voir le produit';
//         $html.= '           </a>';
//         $html.= '       </div>';
//         $html.= '       <div class="product_title">';
//         $html.= '           '.$data_produit['titre'];
//         $html.= '       </div>';
//         $html.= '       <div class="product_description">';
//         $html.= '           '.substr($data_produit['description'],0,50).'...';
//         $html.= '       </div>';

//         if($data_produit['reduction']>0) {
//             $html .= '       <div class="product_price">';
//             $html .= '           '.number_format($data_produit['prixTTC'] - ($data_produit['prixTTC'] / 100 * $data_produit['reduction']),2).' €';
//             $html .= '           <span>' . number_format($data_produit['prixTTC'], 2) . ' € </span>';
//             $html .= '       </div>';
//         } else {
//             $html .= '       <div class="product_price">';
//             $html .= '           ' . number_format($data_produit['prixTTC'], 2) . ' €';
//             $html .= '       </div>';
//         }
//         if($data_produit['qte']>0) {
//             $html .= '       <div class="product_dispo_ok">';
//             $html .= '           En stock';
//             $html .= '       </div>';
//         } else {
//             $html .= '       <div class="product_dispo_ko">';
//             $html .= '           En rupture';
//             $html .= '       </div>';
//         }


//         $html.= '   </div>';
//         $html.= '</div>';
//     }
// }

// $html.= '   </div>';
// $html.= '</div>';