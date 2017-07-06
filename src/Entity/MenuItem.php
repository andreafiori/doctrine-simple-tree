<?php

namespace Entity;

use Knp\DoctrineBehaviors\Model\Tree\Node;
use Knp\DoctrineBehaviors\Model\Tree\NodeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="menu")
 * @Entity(repositoryClass="Entity\MenuItemRepository")
 * @HasLifecycleCallbacks
 */
class MenuItem implements NodeInterface
{
	const PATH_SEPARATOR = '/';

	use Node {

	}

	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Column(name="locale_id", type="string", length=25, nullable=true)
	 */
	protected $localeId;
	
	/**
	 * @Column(type="string", length=255)
	 */
	protected $name;

	/**
	 * @param Collection the children in the tree
	 */
	private $children;

	/**
	 * @param NodeInterface the parent in the tree
	 */
	private $parent;

	/**
	 * @Column(type="string", length=255, nullable=true)
	 */
	private $path;

	/**
	 * @Column(type="integer", nullable=true)
	 */
	private $sort;

	public function __construct()
	{
		$this->children = new ArrayCollection;
	}

	public function __toString()
	{
		return (string) $this->name;
	}

    /**
     * @return mixed
     */
    public function getLocaleId()
    {
        return $this->localeId;
    }

    /**
     * @param mixed $localeId
     */
    public function setLocaleId($localeId)
    {
        $this->localeId = $localeId;
    }

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
}