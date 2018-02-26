<?php

namespace ML\FrontBundle\DoctrineListener;

use Doctrine\ORM\EntityManagerInterface;
use ML\FrontBundle\Entity\Reservation;
use ML\FrontBundle\Entity\Dates;
use Doctrine\ORM\Event\OnFlushEventArgs;


class ReservationListener
{
  /*private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }*/

  public function onFlush(OnFlushEventArgs $args)
  {
    $em = $args->getEntityManager();
    $uow = $em->getUnitOfWork();

     foreach ($uow->getScheduledEntityInsertions() as $key)
     {
       if ($key instanceof Reservation)
       {
         $nbreBill = $key->getTickets()->count();
         $idDate = $key->getDate()->getId();

         $query = $em->createQuery('UPDATE MLFrontBundle:Dates d SET d.soldquantity = d.soldquantity + :billets WHERE d.id = :id');
         $query
             ->setParameter('billets', $nbreBill)
             ->setParameter('id', $idDate);
         $query->execute();
         //var_dump($uow);
         //var_dump($uow->getOriginalEntityData($key));

       }


   }





  }
}









 ?>
