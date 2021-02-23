
<!doctype html>

<html lang="en">
	<head>
	  <meta charset="utf-8">

	  <title>AI Recommendation System</title>
	  <meta name="description" content="The HTML5 Herald">
	  <meta name="author" content="SitePoint">

	  <!---Fonts-->

	  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


	  <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="css/bootstrap.css">

	  <!--- Overrides -->
	  <link rel="stylesheet" href="css/style.css">

	  <!--[if lt IE 9]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	  <![endif]-->
	</head>

	<body style="background-color:white;text-align:center">


	<div class="container">
		<div class="row margin-top-30">
			<div class="col-lg-12">
			 	<a href="index.html">
					<img src="img/logo.png" class="img-center">
				</a>
			</div>
		</div>
	</div>

		<div class="container">
		<div class="row margin-top-30">
			<div class="col-lg-12">
				<h2 class="text-center">Artificial Intelligence</h2>
			</div>
		</div>
	</div>


	<nav class="navbar navbar-default margin-top-30" style="background-color:white">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1 text-center">
      <ul class="nav navbar-nav text-center">
            <li class="navbar-menu" ><a href="index.html">Return to previous page <span class="sr-only">(current)</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php declare(strict_types=1);

namespace App;

$mysql_host = "localhost";
$mysql_username = "root";
$mysql_password = "password";
$mysql_database = "clothesdata";

class Similarity
{
    public static function hamming(string $string1, string $string2, bool $returnDistance = false): float
    {
        $a        = str_pad($string1, strlen($string2) - strlen($string1), ' ');
        $b        = str_pad($string2, strlen($string1) - strlen($string2), ' ');
        $distance = count(array_diff_assoc(str_split($a), str_split($b)));

        if ($returnDistance) {
            return $distance;
        }
        return (strlen($a) - $distance) / strlen($a);
    }

    public static function euclidean(array $array1, array $array2, bool $returnDistance = false): float
    {
        $a   = $array1;
        $b   = $array2;
        $set = [];

        foreach ($a as $index => $value) {
            $set[] = $value - $b[$index] ?? 0;
        }

        $distance = sqrt(array_sum(array_map(function ($x) { return pow($x, 2); }, $set)));

        if ($returnDistance) {
            return $distance;
        }
        // doesn't work well with distances larger than 1
        // return 1 / (1 + $distance);
        // so we'll use angular similarity instead
        return 1 - $distance;
    }

    public static function jaccard(string $string1, string $string2, string $separator = ','): float
    {
        $a            = explode($separator, $string1);
        $b            = explode($separator, $string2);
        $intersection = array_unique(array_intersect($a, $b));
        $union        = array_unique(array_merge($a, $b));

        return count($intersection) / count($union);
    }

    public static function minMaxNorm(array $values, $min = null, $max = null): array
    {
        $norm = [];
        $min  = $min ?? min($values);
        $max  = $max ?? max($values);

        foreach ($values as $value) {
            $numerator   = $value - $min;
            $denominator = $max - $min;
            $minMaxNorm  = $numerator / $denominator;
            $norm[]      = $minMaxNorm;
        }
        return $norm;
    }
}
