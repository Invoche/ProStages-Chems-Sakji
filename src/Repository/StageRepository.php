<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    /**
      * @return Stage[] Returns an array of Stage objects
      */

    public function findByNomEntreprise($nom)
    {
        return $this->createQueryBuilder('s')
            ->join('s.entreprise', 'e')
            ->where('e.nom = :nomEntreprise')
            ->setParameter('nomEntreprise', $nom)
            ->orderBy('s.intitule', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Stage[] Returns an array of Stage objects
     */

    public function findByNomFormation($intitule)
    {
       // Récupérer le gestionnaire d'entité
       $entityManager = $this->getEntityManager();

       // Construction de la requêtemp
       $requete = $entityManager->createQuery(
         'SELECT s
          FROM App\Entity\Stage s
          JOIN s.formation f
          WHERE f.intitule = :intitule');

      // Définition de la valeur du paramètre injecté dans la requête
      $requete -> setParameter ('intitule', $intitule);

       // Exécuter la requête et retourner les résultats
       return $requete->execute();
    }

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
