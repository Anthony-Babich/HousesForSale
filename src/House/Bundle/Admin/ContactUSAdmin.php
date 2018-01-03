<?php

namespace House\Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Show\ShowMapper;

class ContactUSAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class, array(
                'label' => 'Name'
            ))
            ->add('phone', TextType::class, array(
                'label' => 'Phone'
            ))
            ->add('email', TextType::class, array(
                'label' => 'E-mail'
            ))
            ->add('message', TextType::class, array(
                'label' => 'Message'
            ))
            ->add('geoIP', TextType::class, array(
                'label' => 'IP-address'
            ));
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array(
                'label' => 'Name'
            ))
            ->add('phone', null, array(
                'label' => 'Phone'
            ))
            ->add('email', null, array(
                'label' => 'E-mail'
            ))
            ->add('message', null, array(
                'label' => 'Message'
            ))
            ->add('geoIP', null, array(
                'label' => 'IP-address'
            ));
    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, array(
                'label' => 'Name'
            ))
            ->add('phone', null, array(
                'label' => 'Phone'
            ))
            ->add('email', null, array(
                'label' => 'E-mail'
            ))
            ->add('message', null, array(
                'label' => 'Message'
            ))
            ->add('geoIP', null, array(
                'label' => 'IP-address'
            ))
            ->add('created', null, array(
                'label' => 'Date'
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
                'label' => 'Name'
            ))
            ->add('phone', null, array(
                'label' => 'Phone'
            ))
            ->add('email', null, array(
                'label' => 'E-mail'
            ))
            ->add('message', null, array(
                'label' => 'Message'
            ))
            ->add('geoIP', null, array(
                'label' => 'IP-address'
            ))
            ->add('created', null, array(
                'label' => 'Date'
            ));
    }
}