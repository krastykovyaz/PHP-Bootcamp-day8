<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php
			require_once('Dice.class.php');
			new Dice($_POST);
			?>
	<?php
		require_once('Game.class.php');
		new Game($_POST);
	?>

	</body>
</html>