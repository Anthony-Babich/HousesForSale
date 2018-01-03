<?php

namespace House\Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Show\ShowMapper;

class SettingsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', TextType::class, array(
                'label' => 'Title'
            ))
            ->add('setting', TextType::class, array(
                'label' => 'Setting'
            ))
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array(
                'label' => 'Title'
            ))
            ->add('setting', null, array(
                'label' => 'Setting'
            ));
    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title', null, array(
                'label' => 'Title'
            ))
            ->add('setting', null, array(
                'label' => 'Setting'
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
            ->add('title', null, array(
                'label' => 'Title'
            ))
            ->add('setting', null, array(
                'label' => 'Setting'
            ));
    }
}