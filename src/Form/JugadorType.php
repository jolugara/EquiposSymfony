<?php

namespace App\Form;

use App\Entity\Equipo;
use App\Entity\Jugador;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JugadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('equipo',EntityType::class,[
                'class' => Equipo::class,
                'choice_label' => 'nombre',
                'query_builder' => function(EntityRepository $er){
                return $er -> createQueryBuilder('m')
                    ->andWhere('1=1');
                },
                'label' => 'Equipo'
            ])
            ->add('nombre')
            ->add('posicion')
            ->add('fecha_nacimiento')
            ->add('salario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jugador::class,
        ]);
    }
}
