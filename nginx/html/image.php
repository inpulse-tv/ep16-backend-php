<?php
// IMAGE .PHP Améliore toutes nos images JPG

$str_image_demandee = "." .
	substr(
		str_replace ("/", "\\", $_SERVER['REQUEST_URI']),
		0,
		strpos($_SERVER['REQUEST_URI'], '?') ?
			strpos($_SERVER['REQUEST_URI'], '?') : strlen($_SERVER['REQUEST_URI'])
	);
	
// Si le fichier n'existe pas, on retourne 404 au navigateur
if (!file_exists($str_image_demandee)) {
	http_response_code(404);
	exit;
}

// Charge l'image demandée
$image_demandee = imagecreatefromjpeg($str_image_demandee);

// Charge le watermark inpulse
$image_a_ajouter = imagecreatefrompng("watermark.png");

// Calcul des dimensions relatives entre les images
$largeur = min(imagesx($image_demandee), imagesx($image_a_ajouter));
$hauteur = min(imagesy($image_demandee), imagesy($image_a_ajouter));

// Fusionne les images aux coordonées calculées
imagecopyresampled(
	$image_demandee , $image_a_ajouter,
	(imagesx($image_demandee)/2) - $largeur/2, (imagesy($image_demandee)/2) - $hauteur/2,
	0, 0, $largeur, $hauteur, imagesx($image_a_ajouter), imagesy($image_a_ajouter),
	
);

// libère la mémoire
imagedestroy($image_a_ajouter);

// Ajout de texte

$taille_du_texte = imagesx($image_demandee)/30;
$angle_du_texte = 20;
$texte_a_ajouter = "Wazaaaaaa!!!! ".$_SERVER['REMOTE_ADDR']." ".date("Y-m-d H:i:s");

// Calcul de la boite d'insertion du texte
$box = imagettfbbox(
            $taille_du_texte, $angle_du_texte, "font.ttf", $texte_a_ajouter
        );

$width  = (max(array($box[0], $box[2], $box[4], $box[6])) - min(array($box[0], $box[2], $box[4], $box[6])));
$height = (max(array($box[1], $box[3], $box[5], $box[7])) - min(array($box[1], $box[3], $box[5], $box[7])));

// Intégration du texte
imagefttext($image_demandee, $taille_du_texte, $angle_du_texte, 
	imagesx($image_demandee)/2 - $width/2, 
	imagesy($image_demandee)/2 + $height/2,
	imagecolorallocatealpha($image_demandee, 255, 255, 255, 30), 
	"font.ttf", 
	$texte_a_ajouter);

// Prépare la réponse HTTP
header("Content-Type: image/png");
// Joindre l'image pour le navigateur
imagejpeg($image_demandee);
// libère la mémoire
imagedestroy($image_demandee);

?>