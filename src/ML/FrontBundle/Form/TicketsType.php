<?php

namespace ML\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;


class TicketsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$var = range(date('d'), date('t'));
        $var = count($var)-1;*/

        $builder
        ->add('firstname', TextType::class, array(
          'label' => 'Prénom',
        ))
        ->add('lastname',  TextType::class, array(
          'label' => 'Nom',
        ))
        ->add('birthdate', DateType::class, array(
          'widget' => 'single_text',
          'label' => 'Date de naissance',
          'input' => 'datetime',
          'format' => 'dd/MM/yyyy',
          'attr' => array(
          'readonly' => true,
          'class' => 'mydateclass',
          ),
        ))
        ->add('student',   CheckboxType::class, array(
          'label' => 'Tarif Réduit',
          'required' => false,
        ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ML\FrontBundle\Entity\Tickets'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ml_frontbundle_tickets';
    }


}
