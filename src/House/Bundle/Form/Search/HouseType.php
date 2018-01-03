<?php

namespace House\Bundle\Form\Search;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\Translator;

class HouseType extends AbstractType
{
    private $entityManager;
    private $translator;

    public function __construct(EntityManager $entityManager, Translator $translator)
    {
        $this->translator = $translator;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bedrooms', EntityType::class, array(
                'class' => 'HouseBundle:Bedrooms',
                'required' => false,
                'label' => false,
                'placeholder' => $this->translator->trans('selectBedrooms', array(), 'messages', $this->translator->getLocale()),
                'attr' => [
                    'class' => 'selectpicker',
                ],
                'choice_translation_domain' => true,
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('u');
                    return
                        $qb
                            ->select('u')
                            ->orderBy('u.id', 'ASC');
                },
                'choice_label' => 'title',
            ))
            ->add('salesrent', EntityType::class, array(
                'class' => 'HouseBundle:SalesRent',
                'required' => false,
                'label' => false,
                'placeholder' => $this->translator->trans('selectStatus', array(), 'messages', $this->translator->getLocale()),
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
                'choice_translation_domain' => true,
                'choice_label' => 'title',
            ))
            ->add('type', EntityType::class, array(
                'class' => 'HouseBundle:Type',
                'required' => false,
                'label' => false,
                'placeholder' => $this->translator->trans('selectType', array(), 'messages', $this->translator->getLocale()),
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
                'choice_translation_domain' => true,
                'choice_label' => 'title',
            ))
            ->add('priceMin', IntegerType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control'),
                'required' => false,
            ))
            ->add('priceMax', IntegerType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control'),
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