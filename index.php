<?php
//******************** PHP - chargement des donnees ****************/

// recuperation du numero de page, si aucun parametre, on charge la page 1 qui a l'id 0.
((isset($_GET['id']))&&  is_numeric($_GET['id'])) ? $id = $_GET['id']:$id = 0;


function XmlToHtml($id){
		/***************************************************************************
		 * cette fonction collecte les données depuis un fichier xml,puis les tris.*
		 * Elle retourne les données correspondantes à une page donnée.            *
		 ***************************************************************************/

		// on convertit la variable obtenu par _GET en integrale
		$id = (int)$id; //numero de page
		// initialisation des variables
		$title='';
		$menu='';
		$content='';
		$nav =''; 
		
		// recup du fichier xml
		if (!file_exists('source.xml')) 
			{
				exit('Impossible de lire source.xml !!.');
			}
		else
			{
				//on charge le fichier xml	
				$content_page = simplexml_load_file('source.xml');

				// integration des valeurs dans les variables en fonction de la page demandée
				//$title = $content_page->page['id'];
				$title = $content_page->page[$id]->title;
				$menu = $content_page->page[$id]->menu;
				$content = $content_page->page[$id]->content;


				// recuperation des menus pour creer un la navBar
				$i=0; // on compte les pages
				foreach ($content_page as $page) {
				//echo $page->menu;
				$nav = $nav.'<li class="nav-item"><a class="nav-link active" href="?id='.$i.'">'.$page->menu.'</a></li>';
				$i++;
				
				
				}

			}
			$data = ['title'=>$title,'nav'=>$nav,'content'=>$content];
			return $data;			
		}
$data = XmlToHtml($id);
?>
<!-- ******************************** HTML ****************************************-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://www.fontify.me/wf/822845a211e250d3989a107203e72537" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="assets/css/style.css">
	<title><?=  $data['title']; ?></title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<ul class="nav">
				<?= $data['nav']; ?>
			</ul>
		</nav>
	<div class="container jumbotron">
		<div class="row ">
			<div class="col-12">
				<?= $data['content']; ?>
			</div>	
		</div>	
	</div>
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