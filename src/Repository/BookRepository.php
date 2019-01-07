<?php
/**
 * Created by PhpStorm.
 * User: nadirq
 * Date: 07.01.19
 * Time: 2:06
 */

namespace App\Repository;


use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;

class BookRepository extends ServiceEntityRepository
{
    /**
     * @inheritdoc
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * Search records with like by name
     *
     * @param string $name
     *
     * @return array
     */
    public function searchAllByName(string $name): array
    {
        $qb   = $this->createQueryBuilder('b');
        $expr = $qb->expr();
        $qb
            ->select()
            ->where($expr->like('lower(b.name)', ':name'))
            ->setParameter('name', '%' . mb_strtolower($name) . '%');

        return $qb->getQuery()->getResult(AbstractQuery::HYDRATE_OBJECT);
    }
}