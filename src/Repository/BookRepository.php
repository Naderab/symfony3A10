<?php

namespace App\Repository;

use App\Entity\Book;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getBooksByAuthor($author){
        return $this->createQueryBuilder('b')
                    ->join('b.author','a')
                    ->addSelect('a')
                    ->where('a.id = ?1')
                    ->setParameter('1',$author)
                    ->getQuery()
                    ->getResult();
    }

    public function getBooksByAuthorDQL($author){
       $em= $this->getEntityManager();
       $query = $em->createQuery("Select b from App\Entity\Book b Join b.author a where a.id = :id");
       $query->setParameter('id',$author);
       return $query->getResult();
    }

    public function getBookByDate(DateTime $date1,DateTime $date2){
        return $this->createQueryBuilder('b')
                    ->where('b.publicationDate >= :d1')
                    ->andWhere('b.publicationDate <= :d2')
                    ->setParameter('d1',$date1)
                    ->setParameter('d2',$date2)
                    ->getQuery()
                    ->getResult();
    }

    public function getNbbooks(){
        $em= $this->getEntityManager();
        $query = $em->createQuery('select COUNT(b) From App\Entity\Book b');
        return $query->getSingleScalarResult();
    }
}
