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
$version_js = filemtime(plugin_dir_path(__FILE__) . "js/pays.js");
wp_enqueue_style(   'em_plugin_voyage_css',
                     plugin_dir_url(__FILE__) . "style.css",
                     array(),
                     $version_css);

wp_enqueue_script(  'em_plugin_voyage_js',
                    plugin_dir_url(__FILE__) ."js/pays.js",
                    array(),
                    $version_js,
                    true);
}
add_action('wp_enqueue_scripts', 'eddym_enqueue');
/* Création de la liste des destinations en HTML */
function creation_destinations_pays(){
    $contenu =
    '
    <div class="boutons_filtre_pays_content">
        <button class="bouton_filtre_pays">France</button>
        <button class="bouton_filtre_pays">État-Unis</button>
        <button class="bouton_filtre_pays">Canada</button>
        <button class="bouton_filtre_pays">Argentine</button>
        <button class="bouton_filtre_pays">Chili</button>
        <button class="bouton_filtre_pays">Belgique</button>
        <button class="bouton_filtre_pays">Maroc</button>
        <button class="bouton_filtre_pays">Mexique</button>
        <button class="bouton_filtre_pays">Japon</button>
        <button class="bouton_filtre_pays">Italie</button>
        <button class="bouton_filtre_pays">Islande</button>
        <button class="bouton_filtre_pays">Chine</button>
        <button class="bouton_filtre_pays">Grèce</button>
        <button class="bouton_filtre_pays">Suisse</button>
    </div>
    
    <div class="contenue_pays">
    </div>';
    return $contenu;
}

add_shortcode('em_pays', 'creation_destinations_pays');