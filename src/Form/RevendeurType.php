<?php

namespace App\Form;

use App\Entity\Revendeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevendeurType extends AbstractType
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
            ->add('type', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Revendeur::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Revendeur::TYPE;
        $output=[];
        foreach ($choices as $k => $v){
            $output[$v]=$v;
        }
        return $output;
    }
}
