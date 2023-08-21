<?php

namespace App\Repository;

use App\Entity\GameCreator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameCreator>
 *
 * @method GameCreator|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameCreator|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameCreator[]    findAll()
 * @method GameCreator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameCreatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameCreator::class);
    }

    public function save(GameCreator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GameCreator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Ce qui me permet de récupérer et filtrer les informations de la table créateur, ici on cherche
    // le nom du créateur d'un jeu en fonction de son ID
    public function getAllCreatorsName($gameId)
    {
        return $this->createQueryBuilder('g')
            ->select('c.name')
            ->leftJoin('g.creator_id', 'c')
            ->where('g.game_id = :gameId')
            ->setParameter('gameId', $gameId)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return GameCreator[] Returns an array of GameCreator objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GameCreator
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
