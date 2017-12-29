<?php

namespace House\Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Show\ShowMapper;

class FeaturesAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class, array(
                'label' => 'Name En'
            ))
            ->add('nameRu', TextType::class, array(
                'label' => 'Name Ru'
            ))
            ->add('nameAr', TextType::class, array(
                'label' => 'Name Ar'
            ))
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array(
                'label' => 'Name En'
            ))
            ->add('nameRu', null, array(
                'label' => 'Name Ru'
            ))
            ->add('nameAr', null, array(
                'label' => 'Name Ar'
            ))
        ;
    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, array(
                'label' => 'Name En'
            ))
            ->add('nameRu', null, array(
                'label' => 'Name Ru'
            ))
            ->add('nameAr', null, array(
                'label' => 'Name Ar'
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
            ->add('name', null, array(
                'label' => 'Name En'
            ))
            ->add('nameRu', null, array(
                'label' => 'Name Ru'
            ))
            ->add('nameAr', null, array(
                'label' => 'Name Ar'
            ))
        ;
    }
}