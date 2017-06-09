<?php 
function generate($set, $length) {
	$set1 = filter_words($set, $length);
	return $set1[mt_rand(0, count($set1)-1)];
}

function generate_ns($set, $length) {
	$output = "";
	for ($i = 0; $i < $length; $i++) {
		$output .= $set[mt_rand(0, count($set)-1)];
	}
	return $output;
}

function filter_words($set, $size) {
	return array_values(array_filter($set, function($val) use ($size) {
		return strlen($val) == $size;
	}));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$brand = file("brand_words.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$friendly = file("friendly_words.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$num_symb = array_merge(range(0, 9), ['!', '@', '#', '$', '%', '^', '&', '*']);
	array_walk($num_symb, function($val) { 
		return strval($val);
	});
	$total = (int)$_POST["length"];
	if ($total == 4) {
		$password = generate($friendly, $total);
	} elseif ($total < 8) {
		$word_l = mt_rand(2, $total-2); 
		$password = generate($friendly, $word_l);
		$password .= generate_ns($num_symb, $total - $word_l);
	} else {
		$friend_l = mt_rand(2, $total-5); 
		$password = generate($friendly, $friend_l);
		$brand_l = mt_rand(3, min(6, $total-$friend_l-2));
		$password .= generate_ns($num_symb, $total-$friend_l-$brand_l);
		$password .= generate($brand, $brand_l);
	}
}

$title = "Readable Password Generation";
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
			echo "Readable Password Generation";
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