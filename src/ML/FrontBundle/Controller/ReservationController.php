<?php

namespace ML\FrontBundle\Controller;

use ML\FrontBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\FormType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\CollectionType;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Session\Session;
//use ML\FrontBundle\Form\TicketsType;
use ML\FrontBundle\Form\ReservationType;




class ReservationController extends Controller
{

  public function addReservationAction(Request $request)
  {
    $resa = new Reservation();

    $formbuilder = $this->get('form.factory')->createBuilder(ReservationType::class, $resa);  //createbuilder

    /*$formbuilder
      ->add('firstname',  TextType::class, array('label' => 'Prenom'))
      ->add('lastname',    TextType::class, array('label' => 'Nom'))
      ->add('reservationtype', EntityType::class, array(
        'class'        => 'MLFrontBundle:ReservationType',
        'choice_label' => 'name',
        'multiple'     => false,
        'label'        => 'Formule',
      ))
      ->add('dateform', DateType::class, array(
        'label' => 'Date de reservation',
        'widget' => 'single_text',
        'input' => 'datetime',
        'format' => 'dd/MM/yyyy',
        'attr' => array(
          'readonly' => true,
        ),

      ))
      ->add('mail', TextType::class, array('label' => 'Adresse Mail'))
      ->add('tickets', CollectionType::class, array(
        'entry_type'    => TicketsType::class,
        'allow_add'     => true,
        'allow_delete'  => true
      ))
      ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
      ;*/

    $form = $formbuilder->getForm();

    if ($request->isMethod('POST'))
    {
       $form->handleRequest($request);

       if ($form->isValid())
       {
         $service = $this->get('ml_frontbundle.datemanager');
         $var = $service->dateManager($resa->getDateform());

         $em = $this->getDoctrine()->getManager();


         $resa->setDate($var);

         $resa->ticketsPrice();
         $em->persist($resa);
         //$resa->makeRelation();

         //$em->detach($resa);

         $request->getSession()->set('reservation', $resa);

         return $this->redirectToRoute('ml_front_recap');

         //$varr = $request->getSession()->get('reservation');


         //var_dump($varr);
         //var_dump($varr->getTickets());

       }
    }

    return $this->render('MLFrontBundle:Reservation:addform.html.twig', array(
      'form' => $form->createView(),
    ));
  }



}



 ?>
