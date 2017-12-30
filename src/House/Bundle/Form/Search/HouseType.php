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
            ->add("bedrooms", ChoiceType::class, array(
                "label" => false,
                "choices" => $this->getCountBeds(),
                "attr" => [
                    'class' => 'selectpicker',
                ],
                'required' => false,
                'placeholder' => 'Select Bedrooms'
            ))
            ->add("bathrooms", ChoiceType::class, array(
                "label" => false,
                "choices" => $this->getCountBaths(),
                "attr" => [
                    'class' => 'selectpicker',
                ],
                'required' => false,
                'placeholder' => 'Select Bathrooms'
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

    private function getCountBeds(){
        $results = $this->entityManager->getRepository('HouseBundle:House')
            ->createQueryBuilder('e')
            ->select('e.countBed')
            ->groupBy('e.countBed')
            ->orderBy('e.countBed', 'ASC')
            ->getQuery()
            ->getResult();

        $businessUnit = array();
        foreach($results as $bu){
            $businessUnit[$bu['countBed']] = $bu['countBed'];
        }

        return $businessUnit;
    }

    private function getCountBaths(){
        $results = $this->entityManager->getRepository('HouseBundle:House')
            ->createQueryBuilder('e')
            ->select('e.countBath')
            ->groupBy('e.countBath')
            ->orderBy('e.countBath', 'ASC')
            ->getQuery()
            ->getResult();

        $businessUnit = array();
        foreach($results as $bu){
            $businessUnit[$bu['countBath']] = $bu['countBath'];
        }

        return $businessUnit;
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