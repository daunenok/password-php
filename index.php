<?php
function generate($set, $length) {
	$output = "";
	for ($i = 0; $i < $length; $i++) {
		$output .= random_char($set);
	}
	return $output;
}

function random_char($set) {
	$max = strlen($set);
	return $set[rand(0, $max - 1)];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$lowercase = join(range('a', 'z'));
	$uppercase = join(range('A', 'Z'));
	$numbers = join(range(0, 9));
	$symbols = "!@#$%";

	$chars = "";
	if (isset($_POST["lower"])) $chars .= $lowercase;
	if (isset($_POST["upper"])) $chars .= $uppercase;
	if (isset($_POST["numbers"])) $chars .= $numbers;
	if (isset($_POST["symbols"])) $chars .= $symbols;

	$len = $_POST["length"];
	$password = generate($chars, $len);
}

$title = "Password Generation";
require_once "nav.php"; 
?>

<div class="container">
<form class="form-horizontal" method="POST">
	<fieldset>
		<legend>
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			echo "Password: <span>" . $password . "</span>";
		} else {
			echo "Password Generation";
		}
		?>
		</legend>
		<div class="form-group">
			<label for="length" class="col-xs-2 control-label">
			Length
			</label>
			<div class="col-xs-10">
				<input type="number" class="form-control" id="length" name="length" min="4" max="20" value=
				<?php 
				if (isset($_POST["length"])) 
					echo $_POST['length'];
				else
					echo "8";
				?>
				>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-10">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="lower"
<?php if (isset($_POST["lower"])) echo "checked";?>
						>
						Use lowercase
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="upper"
<?php if (isset($_POST["upper"])) echo "checked";?>
						>
						Use uppercase
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="numbers"
<?php if (isset($_POST["numbers"])) echo "checked";?>
						>
						Use numbers
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="symbols"
<?php if (isset($_POST["symbols"])) echo "checked";?>
						>
						Use symbols
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-10 col-xs-offset-2">
				<button type="submit" class="btn btn-primary">
					Generate
				</button>
			</div>
		</div>
	</fieldset>
</form>
</div>

</body>
</html>