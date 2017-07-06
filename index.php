<?php

require_once('vendor/autoload.php');
require_once('bootstrap.php');

use Entity\Categories;
use Entity\CategoryRecursiveIterator;
use Models\CategoryFinder;

$categoryFinder = new CategoryFinder($entityManager);
$arrayCategories = $categoryFinder->findArrayCategories();
$recursive_iterator = $categoryFinder->recoverRecursiveIterator( $categoryFinder->recoverRootCategories() );

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Doctrine 2 MySQL tree with a parent \ child structure">
	<meta name="keywords" content="php,doctrine,mysql,parent child,category">

	<title>Doctrine 2 MySQL tree with a parent \ child structure</title>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container">

	<h2>Doctrine MySQL tree</h2>
	
	<p>A category tree structure with a parent\child relashionship is stored on a MySQL database.<br>
	Here is how a single and standalone Doctrine instance can recover all informations.</p>
	
	<p>&nbsp;</p>

	<form action="" class="form-inline">
		<div class="form-group">
			
				<select name="category" id="category" class="form-control">
					<option value="">Select</option>
					<?php
					$options = '';
					foreach ($recursive_iterator as $index => $child_category):
						$options .= '<option value="' . $child_category->getId() . '">';
						$options .= str_repeat('&nbsp;&nbsp;', $recursive_iterator->getDepth()) . $child_category->getTitle();
						$options .= '</option>';
					endforeach;
					
					echo $options;
					?>
				</select>
			
		</div>
	</form>

	<p>&nbsp;</p>

	<h2>Category array</h2>

	<p>Using a <strong>CategoryRecursiveIterator entity</strong> and a PHP <a href="http://php.net/manual/en/class.recursiveiteratoriterator.php" target="_blank" title="RecursiveIteratorIterator guide on php.net [open page in another window]">RecursiveIteratorIterator</a>, I have built an array with the string of all categories and the related parent \ child relationship:</p>

	<pre><?php print_r($arrayCategories) ?></pre>

	<hr>

	<footer>
		<p>&copy; <?php echo date("Y") ?> - Andrea Fiori. </p>
	</footer>
</div>

</body>
</html>