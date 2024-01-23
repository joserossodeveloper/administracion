<?php
session_start();
require_once "global/variables_globales.php";

if (isset($_POST["password"]) && isset($_POST["username"])) {
	$_SESSION["username_tmp"] = $_POST["username"];
	$sql = "SELECT u.username, u.password, u.is_new, g.level,u.employee_id FROM user u inner join `group` g on u.group_id=g.id where u.username=:un";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':un' => $_POST["username"]));
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($user === false) {
		$_SESSION["error_username"] = "El usuario no existe";
		header("Location: login.php");
		exit;
	} else {
		$password = hash("md5", $_POST["password"] . $salt);
		if ($password===$user["password"]) {
			$_SESSION['user'] = $user;
			header("Location: $url");
			exit;
		} else {
			$_SESSION["error_password"] = "Contraseña incorrecta";
			header("Location: login.php");
			exit;
		}
	}
}
#Definicion de errores
$error_username = isset($_SESSION["error_username"]) ? htmlentities($_SESSION["error_username"]) : "";
$error_password = isset($_SESSION["error_password"]) ? htmlentities($_SESSION["error_password"]) : "";
#Guardado de formulario
$username_tmp = isset($_SESSION['username_tmp']) ? $_SESSION['username_tmp'] : "";
#Clases de validacion
$username_validation_class =  $username_tmp==="" ? "" : ($error_username!=="" ? "is-invalid" : "is-valid");
$password_validation_class =  $error_password==="" ? "" : "is-invalid";

unset($_SESSION["error_username"]);
unset($_SESSION["error_password"]);
unset($_SESSION["username_tmp"]);
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?=$url?>/assets/dist/css/bootstrap.min.css">
	<title>Login</title>
	<style>
		html,
		body {
			height: 100%;
		}
		body {
			display: flex;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="mt-auto d-flex justify-content-center align-items-center">
			<main>
				<form method="post" style="width: 350px;">
					<h1 class="text-center">Iniciar Sesión</h1>
					<div class="mb-3">
						<label for="username" class="form-label">Nombre de usuario</label>
						<input
							type="text"
							class="form-control <?= $username_validation_class ?>"
							id="username"
							name="username"
							value="<?= $username_tmp ?>"
							required
						>
						<?php
						if ($username_validation_class!=="") {
							if ($username_validation_class==="is-invalid") {
								echo "<div class=\"invalid-feedback\">$error_username</div>";
							} else {
								echo "<div class=\"valid-feedback\">¡Se ve bien!</div>";
							}
						}
						?>
					</div>

					<div class="mb-3">
						<label for="password" class="form-label">Contraseña</label>
						<input
							type="password"
							class="form-control <?= $password_validation_class ?>"
							id="password"
							name="password"
							required
						>
						<?php
						if ($password_validation_class!=="") {
							echo "<div class=\"invalid-feedback\">$error_password</div>";
						}
						?>
					</div>
					<button type="submit" class="w-100 btn btn-primary">Acceder</button>
					<!--<a class="w-100 btn btn-secondary" href="/index.php">Regresar</a>-->
				</form>
			</main>
		</div>
	</div>
	<script src="<?=$url?>/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>