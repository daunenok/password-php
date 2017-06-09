<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="flatly.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand">Password Utilities</span>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li
                <?php 
                if ($title == "Password Generation")
                    echo ' class="active"';
                ?>
                >
                    <a href="index.php">
                        Password generation
                    </a>
                </li>
                <li
                <?php 
                if ($title == "Readable Password Generation")
                    echo ' class="active"';
                ?>
                >
                    <a href="readable.php">
                        Readable password generation
                    </a>
                </li>
                <li
                <?php 
                if ($title == "Password Strength Meter")
                    echo ' class="active"';
                ?>
                >
                    <a href="strength.php">
                        Password strength meter
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>