<?php

namespace Models;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection as DoctrineArrayCollection;
use RecursiveIteratorIterator as RecursiveIteratorIterator;

/**
 * Category finder model
 */
class CategoryFinder
{
	private $_entityManager;
	
	/**
	 * @param $entityManager \Doctrine\ORM\EntityManager
	 */
	public function __construct(EntityManager $entityManager)
	{
		$this->_entityManager = $entityManager;
	}
	
	/**
	 * Ugly but necessary: get the array structure
	 * 
	 * @return array
	 */
	public function findArrayCategories()
	{
		$root_categories = $this->recoverRootCategories();

		$recursive_iterator = $this->recoverRecursiveIterator($root_categories);

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
		
		return $arrayCategories;
	}

	/**
	 * Recover root categories
	 * 
	 * @return array
	 */
	public function recoverRootCategories()
	{
		$root_categories = $this->_entityManager->getRepository('Entity\Category')->findBy(array('parent_category' => null));

		return $root_categories;
	}

	/**
	 * Recover an instance of the RecursiveIteratorIterator
	 * 
	 * @param array $root_categories
	 * @return \RecursiveIteratorIterator
	 */
	public function recoverRecursiveIterator($root_categories)
	{
		$collection = new DoctrineArrayCollection($root_categories);
		$category_iterator = new \Entity\CategoryRecursiveIterator($collection);
		$recursive_iterator = new \RecursiveIteratorIterator($category_iterator, RecursiveIteratorIterator::SELF_FIRST);

		return $recursive_iterator;
	}
}