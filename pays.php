<?php
/**
 * Package Pays
 * Version 1.0.0
 */
/*
Plugin name: Pays
Plugin uri: https://github.com/eddytuto
Version: 1.0.0
Description: Permet d'afficher les destinations qui répondent à certains critères de recherche en lien avec le pays
*/
echo header("access-Control-Allow-Origin: http://localhost:8080");
function eddym_enqueue()
{
// filemtime // retourne en milliseconde le temps de la dernière modification
// plugin_dir_path // retourne le chemin du répertoire du plugin
// __FILE__ // le fichier en train de s'exécuter
// wp_enqueue_style() // Intègre le link:css dans la page
// wp_enqueue_script() // intègre le script dans la page
// wp_enqueue_scripts // le hook

$version_css = filemtime(plugin_dir_path( __FILE__ ) . "style.css");
$version_js = filemtime(plugin_dir_path(__FILE__) . "js/voyage.js");
wp_enqueue_style(   'em_plugin_voyage_css',
                     plugin_dir_url(__FILE__) . "style.css",
                     array(),
                     $version_css);

wp_enqueue_script(  'em_plugin_voyage_js',
                    plugin_dir_url(__FILE__) ."js/voyage.js",
                    array(),
                    $version_js,
                    true);
}
add_action('wp_enqueue_scripts', 'eddym_enqueue');
/* Création de la liste des destinations en HTML */
function creation_destinations_pays(){
    $contenu =
    '
    <form class="boutons_filtre_pays">
        <button class="bouton_filtre">France</button>
        <button class="bouton_filtre">État-Unis</button>
        <button class="bouton_filtre">Canada</button>
        <button class="bouton_filtre">Argentine</button>
        <button class="bouton_filtre">Chili</button>
        <button class="bouton_filtre">Belgique</button>
        <button class="bouton_filtre">Maroc</button>
        <button class="bouton_filtre">Mexique</button>
        <button class="bouton_filtre">Japon</button>
        <button class="bouton_filtre">Italie</button>
        <button class="bouton_filtre">Islande</button>
        <button class="bouton_filtre">Chine</button>
        <button class="bouton_filtre">Grèce</button>
        <button class="bouton_filtre">Suisse</button>
    </form>
    
    <div class="contenu__restapi__pays">
    </div>';
    return $contenu;
}

add_shortcode('em_pays', 'creation_destinations_pays');