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
                'label' => 'Дом/квартира'
            ))
            ->add('startDate', DateTimeType::class, array(
                'label' => 'Аренда с',
            ))
            ->add('endDate', DateTimeType::class, array(
                'label' => 'по',
            ))
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('idHouse', null, array(
                'label'    => 'Дом/квартира'
            ), 'entity', array(
                'class' => 'HouseBundle:House',
                'property' => 'title',
            ))
            ->add('startDate', null, array(
                'label' => 'Аренда с'
            ))
            ->add('endDate', null, array(
                'label' => 'по'
            ));
    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('idHouse.title', null, array(
                'label'    => 'Дом/квартира'
            ))
            ->add('startDate', null, array(
                'label' => 'Аренда с'
            ))
            ->add('endDate', null, array(
                'label' => 'по'
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
                'label'    => 'Дом/квартира'
            ))
            ->add('startDate', null, array(
                'label' => 'Аренда с'
            ))
            ->add('endDate', null, array(
                'label' => 'по'
            ));
    }
}