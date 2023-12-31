<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
		<link rel="stylesheet" href="trop_style.css">
	</head>
	<body>
		<?php
			// code exécuté sur le serveur
			$numero_du_jour_de_la_semaine = date('w');
			//echo "<p>Le n° du jour est {$numero_du_jour_de_la_semaine}</p>";
			$semaine = ['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'];
			$jour_de_la_semaine = $semaine[ $numero_du_jour_de_la_semaine ];
			

		?>
		<itv-entete class="bg">
			<h1>Menu du <?=$jour_de_la_semaine ?> </h1>
		</itv-entete>
		<?php
			$db = new SQLite3("c:\demo\pouletmayo.db");
			
			//$res = $db->query("SELECT * FROM ENTREES WHERE JOUR=STRFTIME('%w','now');");
			$res = $db->query("SELECT * FROM ENTREES WHERE jour={$numero_du_jour_de_la_semaine};");
				
		?>
		<itv-outils-espace></itv-outils-espace>
		<itv-outils-haut class="bg">
			<itv-option id="option-vegan"><p >Vegan</p></itv-option>
			
			<itv-option id="option-viandard"><p>Viandard sensible</p></itv-option>
			<itv-option id="option-pas-du-tout-vegan" class="option-choisie">
				<p>Véquoi?</p>
			</itv-option>
		</itv-outils-haut>
		<itv-outils-espace></itv-outils-espace>
		<itv-outils-haut class="bg">
			<itv-option id="option-petite-faim"><p>Petite faim</p></itv-option>
			<itv-option id="option-grosse-dalle" class="option-choisie">
				<p>Grosse dalle</p>
			</itv-option>
		</itv-outils-haut>
		<itv-outils-espace></itv-outils-espace>
		<itv-scrollable class="bg">
			<h2 class="grosse-dalle">Entrées</h2>
			<?php while ($row = $res->fetchArray()){ ?>
				<itv-plat class="grosse-dalle">
				<?php if ($row['Vegan'] >0) { ?>
					<itv-vegan>
				<?php } else { ?>
					<itv-viandard>
				<?php } ?>
							
					<h3><?= $row['Nom'] ?></h3>
					<p><?= $row['Description'] ?></p>
					
				<?php
					if ($row['Vegan'] >0) {
						echo "</itv-vegan>";
					} else {
						echo "</itv-viandard>";
					}
				?>
					
				</itv-plat>
			<?php } ?>
			<?php $db->close(); ?>
			<h2>Plat</h2>
			<itv-plat>
				<h3>Etouffe-Chrétien</h3>
				<p> C'est au figuré <br>
					En vrai on n'a rien contre les chrétiens
					d'ailleurs j'ai un ami chrétien, et 
					il <strong>adore</strong> ce
					<itv-dejeuner>
						<itv-plat-principal> 
							Sandwich 
						</itv-plat-principal>
						<itv-garniture>
							<itv-vegan>
								<a href="https://vegan-pratique.fr/cote-cuisine/cuisiner-proteines-de-soja-texturees/">
									protéines de soja texturées
								</a>
							</itv-vegan>
							<itv-viandard>
								<a href="https://fr.wikipedia.org/wiki/poulet">
									poulet
								</a>
							</itv-viandard>
						</itv-garniture>
						<itv-sauce>
							mayonnaise <itv-vegan>vegan</itv-vegan>
						</itv-sauce>
						<itv-boisson/>
					</itv-dejeuner>
					<br>
				</p>
			</itv-plat>
		</itv-scrollable>
		<itv-outils-espace></itv-outils-espace>
		<itv-outils-bas class="bg">
			<itv-option id="option-abonnes" class="option-choisie">
				<p>Abonnés à inpulse.tv</p>
			</itv-option>
			<itv-option id="option-militaires"><p>Pompiers et militaires</p></itv-option>
			<itv-option id="option-les-autres"><p>Les autres</p></itv-option>
		</itv-outils-bas>
		<itv-outils-espace></itv-outils-espace>
		<itv-outils-bas class="bg">
			<itv-prix>
				<h2>Prix "à la tête du client"</h2>
				<p>7 €</p>
			</itv-prix>
		</itv-outils-bas>
		<itv-outils-espace></itv-outils-espace>
		<itv-outils-bas class="bg">
			<itv-option><p>Commander</p></itv-option>
		</itv-outils-bas>
		<itv-outils-espace ></itv-outils-espace>
	</body>
	<script src="poulet-mayonnaise.js"></script>
</html>












