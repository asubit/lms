<?php

namespace LmsBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LessonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LessonRepository extends EntityRepository
{
    public function findByFilter($filter)
    {
        return $this->createQueryBuilder('l')
            ->where('l.theme = :theme')
            ->setParameter('theme', $filter)
            ->addOrderBy('l.theme', "ASC")
            ->addOrderBy('l.id', "ASC")
            ->setMaxResults(20);
    }
}
