<?php 
function count_upper($str) {
	return preg_match_all('/[A-Z]/', $str);
}

function count_numbers($str) {
	return preg_match_all('/[0-9]/', $str);
}

function count_symbols($str) {
	$regex = '/[' . preg_quote('!@#$%^&*') . ']/';
	return preg_match_all($regex, $str);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$points = 0;
	$pass = $_POST["pass"];
	if (strlen($pass) >= 8) {
		$points += 2;
		$points += min(4, (strlen($pass)-8)/2);
	}
	if (strtolower($pass) != $pass) $points += 1;
	if (strtoupper($pass) != $pass) {
		$points += 1;
		$points += min(3, count_upper($pass)/2);
	}
	if (count_numbers($pass) > 0) {
		$points += 1;
		$points += min(3, count_numbers($pass)/2);
	}
	if (count_symbols($pass) > 0) {
		$points += 1;
		$points += min(3, count_symbols($pass)/2);
	}
	$points = floor($points / 19 * 10);
	if ($points == 0) $points = 1;
}

$title = "Password Strength Meter";
require_once "nav.php"; 
?>

<div class="container">
<form class="form-horizontal" method="POST">
	<fieldset>
		<legend>
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			echo "Strength:&nbsp;&nbsp;&nbsp;";
			for ($i = 0; $i < 10; $i++) {
				echo "<span class='meter"; 
				if ($i < $points) echo " met" . $points;
				echo "'></span>";
			}
		} else {
			echo "Password Strength Meter";
		}
		?>
		</legend>
		<div class="form-group">
			<label for="pass" class="col-xs-4 control-label">
			Password
			</label>
			<div class="col-xs-8">
				<input type="text" class="form-control" id="pass" name="pass" min="4" max="20" value=
				<?php 
				if (isset($_POST["pass"])) 
					echo $_POST['pass'];
				else
					echo "";
				?>
				>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-10 col-xs-offset-2">
				<button type="submit" class="btn btn-primary">
					Meter
				</button>
			</div>
		</div>
	</fieldset>
</form>
</div>

</body>
</html>