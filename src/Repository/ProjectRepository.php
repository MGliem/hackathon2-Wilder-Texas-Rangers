<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function add(Project $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Project $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Project[] Returns an array of Project objects
//     */
    public function findLike($search)
    {
        return $this->createQueryBuilder('p')
           ->Where('p.name LIKE :val')
           ->orWhere('p.content LIKE :val')
           ->orWhere('p.team LIKE :val')
           ->setParameter('val', '%' . $search . '%')
           ->orderBy('p.id', 'DESC')
           ->getQuery()
           ->getResult()
       ;
    }

    public function findOneNotlikeApsidian($user): ?Project
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.matchings', 'pm')
            ->Where('pm.apsidian != :user')
            ->orWhere('pm.apsidian is null')
            ->setParameter('user', $user)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findOnelikeApsidian(): ?Project
    {
        return $this->createQueryBuilder('p')
            ->join('p.matchings', 'pm')
            ->Where('pm.apsidianLike = true')
            ->andWhere('pm.masterChief is null')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
