<?php

namespace Entity;

/**
 * @Entity
 * @Table(name="category")
 */
class Category
{
	/**
	 * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;

	/**
	 * @Column(type="string", length=130, nullable=false)
	 */
	protected $title;

	/**
	 * @ManyToOne(targetEntity="Category", inversedBy="child_categories")
	 * @JoinColumn(name="parent_category_id", referencedColumnName="id")
	 */
	protected $parent_category;

	/**
	 * @OneToMany(targetEntity="Category", mappedBy="parent_category")
	 */
	protected $child_categories;

	public function __construct()
	{
		$this->child_categories = new \Doctrine\Common\Collections\ArrayCollection;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return mixed
	 */
	public function getParentCategory()
	{
		return $this->parent_category;
	}

	/**
	 * @return int \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getChildCategories()
	{
		return $this->child_categories;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @param int $parent_category
	 */
	public function setParentCategory($parent_category)
	{
		$this->parent_category = $parent_category;
	}
	
	/**
	 * @param int $child_categories
	 */
	public function setChildCategories($child_categories)
	{
		$this->child_categories = $child_categories;
	}
}
