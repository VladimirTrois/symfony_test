<?php

namespace App\Form;

use App\Entity\Checklist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChecklistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note', IntegerType::class)
            ->add('revendeur')
            ->add('service', ChoiceType::class, [
                'required' => false,
                'choices' => $this->getChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Checklist::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Checklist::SERVICE;
        $output=[];
        foreach ($choices as $k => $v){
            $output[$v]=$v;
        }
        return $output;
    }
}
