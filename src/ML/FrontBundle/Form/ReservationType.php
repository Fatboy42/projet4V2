<?php

namespace ML\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ML\FrontBundle\Form\TicketsType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Session\Session;
use ML\FrontBundle\Entity\Reservation;


class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
          'input'  => 'datetime',
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
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ML\FrontBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ml_frontbundle_reservation';
    }


}
