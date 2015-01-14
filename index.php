<?php

require_once "vendor/autoload.php";
require_once "bootstrap.php";

use Entity\Categories;
use Entity\CategoryRecursiveIterator;

/** @var $entityManager \Doctrine\ORM\EntityManager */
$root_categories = $entityManager->getRepository('Entity\Category')->findBy(array('parent_category' => null));

$collection = new \Doctrine\Common\Collections\ArrayCollection($root_categories);
$category_iterator = new \Entity\CategoryRecursiveIterator($collection);
$recursive_iterator = new \RecursiveIteratorIterator($category_iterator, RecursiveIteratorIterator::SELF_FIRST);


?>
<select name="category">
<?php

foreach ($recursive_iterator as $index => $child_category)
{
    echo '<option value="' . $child_category->getId() . '">' . str_repeat('&nbsp;&nbsp;', $recursive_iterator->getDepth()) . $child_category->getTitle() . '</option>';
}

?>
</select><br><br>
<?php

$arrayCategories = array();
foreach ($recursive_iterator as $index => $child_category)
{
	$arrayCategories[$child_category->getId()] = $child_category->getTitle();
}
var_dump($arrayCategories);