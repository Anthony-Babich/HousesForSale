<?php

namespace House\Bundle\Form\Search;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class HouseType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bedrooms', EntityType::class, array(
                'class' => 'HouseBundle:Bedrooms',
                'required' => false,
                'label' => false,
                'placeholder' => 'Select Bedrooms',
                'attr' => [
                    'class' => 'selectpicker',
                ],
                'choice_label' => 'title',
            ))
            ->add('salesrent', EntityType::class, array(
                'class' => 'HouseBundle:SalesRent',
                'required' => false,
                'label' => false,
                'placeholder' => 'Select Status',
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('u');
                    return
                        $qb
                            ->select('u')
                            ->where('u.title NOT LIKE :salesRent')
                            ->setParameter('salesRent','%Buy+Rent%');
                },
                'attr' => [
                    'class' => 'selectpicker',
                ],
                'choice_label' => 'title',
            ))
            ->add('type', EntityType::class, array(
                'class' => 'HouseBundle:Type',
                'required' => false,
                'label' => false,
                'placeholder' => 'Select Type',
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('u');
                    return
                        $qb
                            ->select('u')
                            ->where('u.title NOT LIKE :land')
                            ->setParameter('land','%Land%');
                },
                'attr' => [
                    'class' => 'selectpicker',
                ],
                'choice_label' => 'title',
            ))
            ->add("price", TextType::class, array(
                "label" => 'Price',
                "attr" => array("class" => "form-control"),
                'required' => false,
            ))
        ;
    }

    public function getDefaultOptions()
    {
        return array(
            'csrf_protection' => false,
        );
    }

    function getName()
    {
        return 'searchorg';
    }
}