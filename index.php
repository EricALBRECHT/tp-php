<?php
// recuperation du numero de page, si aucun parametre, on charge la page 1.
(isset($_GET['id'])) ? $id = $_GET['id']:$id = 1;

// on passe la variable get en integrale
	$id = (int)$id;
// initialisation des variables
	 $title='';
	 $menu='';
	 $content='';

// recup du fichier xml
if (!file_exists('source.xml')) {
	 exit('Impossible de lire individus.xml.');
}else{
//on charge le fichier xml	
$content_page = simplexml_load_file('source.xml');

// integration des valeurs
$title = $content_page->page['id'];

$title = $content_page->page[$id]->title;
$menu = $content_page->page[$id]->menu;
$content = $content_page->page[$id]->content;

$nav =""; 
//echo $title;
$i=0;
foreach ($content_page as $page) {
//echo $page->menu;
$nav = $nav.'<li><a href="?id='.$i.'">'.$page->menu.'</a></li>';
$i++;
}

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= $title; ?></title>
</head>
<body>
	
	<div class="content">
	<ul>
		<?= $nav; ?>
	</ul>
	<?= $content; ?></div>
</body>
</html>

<!-- Descriptif du XML
•Page : page du site
•id : identifiant de la page. Sert aussi à naviguer
•menu : texte du menu
•title : titre de la page
•content : contenu de la page

Vous n'aurez le droit que d'ajouter des classes ou des ids dans le code HTML du nœud content. Cela pour vous permettre de styliser vos pages. La structure ne doit pas être modifiée.
 Vous devrez réécrire les urls pour qu'elles prennent le numéro de l'attribut id du nœud page suivit de l'extension html
 Ex : 1.html
-->