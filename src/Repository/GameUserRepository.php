<?php

namespace App\Repository;

use App\Entity\GameUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameUser>
 *
 * @method GameUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameUser[]    findAll()
 * @method GameUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameUser::class);
    }

    public function save(GameUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GameUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllGamesfromUser($userId)
    {
        return $this->createQueryBuilder('gu') // Using 'gu' as alias for gameUser entity
        ->select('gu.timeSpent', 'gu.note', 'u.username', 'g.title', 'g.image', 'gu.statut', 'g.releaseDate') // Using 'gu' alias for selecting from gameUser entity
        ->leftJoin('gu.game_id', 'g') // Using 'g' as alias for the game_id association
        ->leftJoin('gu.user_id', 'u') // Using 'u' as alias for the user_id association
        ->where('gu.user_id = :userId')
        ->setParameter('userId', $userId)
        ->getQuery()
        ->getResult();
    }

//    /**
//     * @return GameUser[] Returns an array of GameUser objects
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

//    public function findOneBySomeField($value): ?GameUser
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
