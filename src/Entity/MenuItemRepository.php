<?php

namespace Entity;

use Doctrine\ORM\EntityRepository;

class MenuItemRepository extends EntityRepository
{
	public function getRootNodes()
	{
		$qb = $this->createQueryBuilder('m')
				   ->andWhere('m.path NOT LIKE :path')
				   ->setParameter('path', '%%')
		;

		return $qb->getQuery()->execute();
	}

	public function buildTree(MenuItem $root)
	{
		$qb = $this-createQueryBuilder('m')
						->andWhere('m.path LIKE :path')
						->andWhere	('m.id != :id')
						->addOrderBy('m.path', 'ASC')
						->addOrderBy('m.sort', 'ASC')
						->setParameter('path', $root->getPath().'%')
						->setParameter('id', $root->getId())
		;
		
		$results = $qb->getQuery()->execute();

		$root->buildTree(new ArrayObject($results));
	}
}