<?php

namespace House\Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Show\ShowMapper;

class HouseAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Основные характеристики')
                ->with('Характеристики', array('class' => 'col-xs-12 col-md-6'))
                    ->add('title', TextType::class, array(
                        'label' => 'Название'
                    ))
                    ->add('description', TextType::class, array(
                        'label' => 'Описание'
                    ))
                    ->add('street', TextType::class, array(
                        'label' => 'Улица'
                    ))
                    ->add('name', TextType::class, array(
                        'label' => 'Уникальное название на англ. для поиска'
                    ))
                    ->add('priceRent', IntegerType::class, array(
                        'label' => 'Цена для аренды'
                    ))
                    ->add('priceSale', IntegerType::class, array(
                        'label' => 'Цена для продажи'
                    ))
                    ->add('latitude', TextType::class, array(
                        'label' => 'Широта'
                    ))
                    ->add('longitude', TextType::class, array(
                        'label' => 'Долгота'
                    ))
                    ->add('countBath', IntegerType::class, array(
                        'label' => 'Количество душевых'
                    ))
                    ->add('countBed', IntegerType::class, array(
                        'label' => 'Количество комнат'
                    ))
                    ->add('sq', IntegerType::class, array(
                        'label' => 'Площадь'
                    ))
                ->end()

                ->with('Тип', array('class' => 'col-xs-12 col-md-6'))
                    ->add('idSalesRent', EntityType::class, array(
                        'class' => 'HouseBundle:SalesRent',
                        'property' => 'title',
                        'label' => 'Аредна/продажа'
                    ))
                    ->add('idType', EntityType::class, array(
                        'class' => 'HouseBundle:Type',
                        'property' => 'title',
                        'label' => 'Тип недвижимости'
                    ))
                    ->add('idBedrooms', EntityType::class, array(
                        'class' => 'HouseBundle:Bedrooms',
                        'property' => 'title',
                        'label' => 'Тип комнат'
                    ))
                ->end()
            ->end()

            ->tab('Картинки')
            ->with('Большие картинки', array('class' => 'col-xs-12 col-md-6'))
            ->add('images', 'sonata_type_model', array(
                'class' => 'HouseBundle:Images',
                'property' => 'imageName',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'label' => false
            ))
            ->end()
            ->with('Маленькие картинки', array('class' => 'col-xs-12 col-md-6'))
            ->add('imagesSmall', 'sonata_type_model', array(
                'class' => 'HouseBundle:ImagesSmall',
                'property' => 'imageName',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'label' => false
            ))
            ->end()
            ->end()

            ->tab('Подробная информация и особенности')
            ->with('Подробная информация', array('class' => 'col-xs-12 col-md-6'))
            ->add('adDetails', 'sonata_type_model', array(
                'class' => 'HouseBundle:AdDetails',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'label' => false
            ))
            ->end()
            ->with('Особенности', array('class' => 'col-xs-12 col-md-6'))
            ->add('features', 'sonata_type_model', array(
                'class' => 'HouseBundle:Features',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'label' => false
            ))
            ->end()
            ->end()
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array(
                'label' => 'Название'
            ))
            ->add('idSalesRent', null, array(
                'label'    => 'Аредна/продажа'
            ), 'entity', array(
                'class' => 'HouseBundle:SalesRent',
                'property' => 'title',
            ))
            ->add('idType', null, array(
                'label'    => 'Тип недвижимости'
            ), 'entity', array(
                'class' => 'HouseBundle:Type',
                'property' => 'title',
            ))
            ->add('idBedrooms', null, array(
                'label'    => 'Тип комнат'
            ), 'entity', array(
                'class' => 'HouseBundle:Bedrooms',
                'property' => 'title',
            ))
            ->add('countBath', null, array(
                'label' => 'Количество душевых'
            ))
            ->add('countBed', null, array(
                'label' => 'Количество комнат'
            ))
            ->add('priceRent', null, array(
                'label' => 'Цена для аренды'
            ))
            ->add('priceSale', null, array(
                'label' => 'Цена для продажи'
            ));
    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title', null, array(
                'label' => 'Название'
            ))
            ->add('idSalesRent.title', null, array(
                'label'    => 'Аредна/продажа'
            ))
            ->add('idType.title', null, array(
                'label'    => 'Тип недвижимости'
            ))
            ->add('idBedrooms.title', null, array(
                'label'    => 'Тип комнат'
            ))
            ->add('countBath', null, array(
                'label' => 'Количество душевых'
            ))
            ->add('countBed', null, array(
                'label' => 'Количество комнат'
            ))
            ->add('priceRent', null, array(
                'label' => 'Цена для аренды'
            ))
            ->add('priceSale', null, array(
                'label' => 'Цена для продажи'
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
                'label' => 'Название'
            ))
            ->add('idSalesRent.title', null, array(
                'label'    => 'Аредна/продажа'
            ))
            ->add('idType.title', null, array(
                'label'    => 'Тип недвижимости'
            ))
            ->add('idBedrooms.title', null, array(
                'label'    => 'Тип комнат'
            ))
            ->add('countBath', null, array(
                'label' => 'Количество душевых'
            ))
            ->add('countBed', null, array(
                'label' => 'Количество комнат'
            ))
            ->add('priceRent', null, array(
                'label' => 'Цена для аренды'
            ))
            ->add('priceSale', null, array(
                'label' => 'Цена для продажи'
            ));
    }
}