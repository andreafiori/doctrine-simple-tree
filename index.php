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

?>
<select name="category">
	<option value="">Select</option>
	<?php
	$options = '';
	foreach ($recursive_iterator as $index => $child_category)
	{
		$options .= '<option value="' . $child_category->getId() . '">';
		$options .= str_repeat('&nbsp;&nbsp;', $recursive_iterator->getDepth()) . $child_category->getTitle();
		$options .= '</option>';
	}
	echo $options;
	?>
</select>
<br>

<?php

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

var_dump($arrayCategories);


/* Print all categories */
$arrayCategories = array();
foreach ($recursive_iterator as $index => $child_category)
{
	$arrayCategories[$child_category->getId()] = $child_category->getTitle();
}

var_dump($arrayCategories);
