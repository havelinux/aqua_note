<?php


namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GenusRepository extends EntityRepository
{

  public function findAllPublishedOrderedBySize()
  {
    /**
     * @return Genus[]
     */
    return $this->createQueryBuilder('genus')
      ->andWhere('genus.isPublished = :isPublished')
      ->setParameter('isPublished', true)
      ->orderBy('genus.speciesCount', 'DESC')
      ->getQuery()
      ->execute();
  }

  public function findAllPublishedOrderedByRecentlyActive()
  {
    /**
     * @return Genus[]
     */
    return $this->createQueryBuilder('genus')
      ->andWhere('genus.isPublished = :isPublished')
      ->setParameter('isPublished', true)
      ->leftJoin('genus.notes', 'genus_note')
      ->orderBy('genus_note.createdAt', 'DESC')
      ->getQuery()
      ->execute();
  }

}