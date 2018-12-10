<?php

namespace App\Form;

use App\Entity\Brasserie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrasserieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('numero_rue', IntegerType::class)
            ->add('rue', TextType::class)
            ->add('code_postale', IntegerType::class)
            ->add('ville', TextType::class)
            ->add('pays', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Brasserie::class,
        ]);
    }
}
