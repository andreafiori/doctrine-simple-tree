<?php

require_once('vendor/autoload.php');
require_once('bootstrap.php');

use Entity\Categories;
use Entity\CategoryRecursiveIterator;

/**
 * @var $entityManager \Doctrine\ORM\EntityManager 
 */
$root_categories = $entityManager->getRepository('Entity\Category')->findBy(array('parent_category' => null));

$collection = new \Doctrine\Common\Collections\ArrayCollection($root_categories);
$category_iterator = new \Entity\CategoryRecursiveIterator($collection);
$recursive_iterator = new \RecursiveIteratorIterator($category_iterator, RecursiveIteratorIterator::SELF_FIRST);


$arrayCategories = array();
foreach ($recursive_iterator as $index => $child_category)
{
	// TODO: transform the following code block into a recursive function

	$stringToPush = '';
	$parents = $child_category->getParentCategory();

	if ( empty($parents) ) {
		$stringToPush .= $child_category->getTitle();

		$arrayCategories[$child_category->getId()] = $stringToPush;

		$childs = $child_category->getChildCategories();

		if (!empty($childs)) {
			foreach($child_category->getChildCategories() as $child) {
				$stringToPush .= " > ".$child->getTitle();
				$arrayCategories[$child->getId()] = $stringToPush;

				if ($child->getChildCategories()) {
					foreach($child->getChildCategories() as $child2) {
						$arrayCategories[$child2->getId()] = $stringToPush." > ".$child2->getTitle();

						if ($child2->getChildCategories()) {
							foreach($child2->getChildCategories() as $child3) {
								$arrayCategories[$child3->getId()] = $stringToPush." > ".$child2->getTitle().' > '.$child3->getTitle();
							}
						}
					}
				}
			}
		}
	}
}


/* Print all categories */
// $arrayCats = array();
// foreach ($recursive_iterator as $index => $child_category) {
	// $arrayCats[$child_category->getId()] = $child_category->getTitle();
// }

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
			<label for="category" class="control-label col-sm-5">Tree categories:</label>
			<div class="col-sm-7">
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
		</div>
	</form>
	
	<p>&nbsp;</p>
	
	<h2>Category array</h2>
	
	<p>Using a <strong>CategoryRecursiveIterator entity</strong> and a PHP <a href="http://php.net/manual/en/class.recursiveiteratoriterator.php" target="_blank" title="RecursiveIteratorIterator guide on php.net [open page in another window]">RecursiveIteratorIterator</a>, I have built an array with the string of all categories and the related parent \ child relationship:</p>
	
	<pre><?php print_r($arrayCategories) ?></pre>
	
	<hr>
	
	<footer>
		<small>&copy; <?php echo date("Y") ?> - Andrea Fiori. </small>
	</footer>
</div>

<script src="../../common/jquery/jquery.min.js"></script>
<script src="../../common/bootstrap3/js/bootstrap.min.js"></script>

</body>
</html>