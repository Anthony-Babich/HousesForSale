<?php

namespace House\Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RentalDatesAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('idHouse', EntityType::class, array(
                'class' => 'HouseBundle:House',
                'property' => 'title',
                'label' => 'House/apartment'
            ))
            ->add('startDate', DateTimeType::class, array(
                'label' => 'Rent from',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array('class' => 'date')
            ))
            ->add('endDate', DateTimeType::class, array(
                'label' => 'to',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array('class' => 'date')
            ))
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idHouse', null, array(
                'label'    => 'House/apartment'
            ), 'entity', array(
                'class' => 'HouseBundle:House',
                'property' => 'title',
            ))
            ->add('startDate', null, array(
                'label' => 'Rent from'
            ))
            ->add('endDate', null, array(
                'label' => 'to'
            ));
    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('idHouse.title', null, array(
                'label'    => 'House/apartment'
            ))
            ->add('startDate', null, array(
                'label' => 'Rent from'
            ))
            ->add('endDate', null, array(
                'label' => 'to'
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ));
    }
    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('idHouse.title', null, array(
                'label'    => 'House/apartment'
            ))
            ->add('startDate', null, array(
                'label' => 'Rent from'
            ))
            ->add('endDate', null, array(
                'label' => 'to'
            ));
    }
}