<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<title>Studeffi - Gestion Compteurs</title>
	<link rel="icon" type="image/x-icon" href="./assets/images/favicon.png">

</head>
<body class="d-flex flex-column min-vh-100">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient">
			<div class="container-fluid">
				<span class="navbar-brand">
                    Studeffi - Gestion Compteurs
				</span>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<?php if (!empty($_SESSION)) { ?>
							<li class="nav-item">
								<a class="nav-link active" href="./index.php?page=compteur_main.php">
									<i class="bi bi-building"></i>&nbsp;Gestion des compteurs
								</a>
							</li>

						<?php } ?>
					</ul>
					<?php 
						$pageHeader = (!empty($_SESSION)) ? "./logout.php" : "./index.php?page=login";
						$btnText = (!empty($_SESSION)) ? htmlspecialchars($_SESSION['username']) . '&nbsp;<i class="bi bi-box-arrow-right"></i>' : "Login";
						$btnColor = (!empty($_SESSION)) ? 'primary text-light' : "outline-light";
					?>
					<span class="navbar-text">
						<a class="btn btn-<?php echo $btnColor; ?>" href="<?php echo htmlspecialchars($pageHeader); ?>">
							<?php echo $btnText; ?>
						</a>
					</span>
				</div>
			</div>
		</nav>
	</header>