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
                        'label' => 'Title En'
                    ))
                    ->add('titleRu', TextType::class, array(
                        'label' => 'Title Ru'
                    ))
                    ->add('titleAr', TextType::class, array(
                        'label' => 'Title Ar'
                    ))
                    ->add('street', TextType::class, array(
                        'label' => 'Address En'
                    ))
                    ->add('streetRu', TextType::class, array(
                        'label' => 'Address Ru'
                    ))
                    ->add('streetAr', TextType::class, array(
                        'label' => 'Address Ar'
                    ))
                    ->add('name', TextType::class, array(
                        'label' => 'Unique name in English'
                    ))
                    ->add('priceRent', IntegerType::class, array(
                        'label' => 'Цена для аренды',
                        'required' => false
                    ))
                    ->add('priceSale', IntegerType::class, array(
                        'label' => 'Цена для продажи',
                        'required' => false
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
                    ->add('description', 'genemu_tinymce', array(
                        'label' => 'Description En',
                        'configs' => array(
                            'add_unload_trigger' => 'false',
                            'remove_linebreaks' => 'true',
                            'inline_styles' => 'true',
                            'convert_fonts_to_spans' => 'true',
                            'elements' => "content_editor",
                            'plugins' => "autolink,lists,spellchecker,pagebreak,table,preview,save,insertdatetime,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",
                            'theme_advanced_buttons1' => "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                            'theme_advanced_buttons2' => "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,uploads_image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                            'theme_advanced_buttons3' => "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                            'theme_advanced_buttons4' => "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote,pagebreak,|,insertfile,insertimage",
                            'theme_advanced_toolbar_location' => "top",
                            'theme_advanced_toolbar_align' => "left",
                            'theme_advanced_statusbar_location' => "bottom",
                            'theme_advanced_resizing' => true,
                        )
                    ))
                    ->add('descriptionRu', 'genemu_tinymce', array(
                        'label' => 'Description Ru',
                        'configs' => array(
                            'add_unload_trigger' => 'false',
                            'remove_linebreaks' => 'true',
                            'inline_styles' => 'true',
                            'convert_fonts_to_spans' => 'true',
                            'elements' => "content_editor",
                            'plugins' => "autolink,lists,spellchecker,pagebreak,table,preview,save,insertdatetime,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",
                            'theme_advanced_buttons1' => "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                            'theme_advanced_buttons2' => "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,uploads_image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                            'theme_advanced_buttons3' => "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                            'theme_advanced_buttons4' => "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote,pagebreak,|,insertfile,insertimage",
                            'theme_advanced_toolbar_location' => "top",
                            'theme_advanced_toolbar_align' => "left",
                            'theme_advanced_statusbar_location' => "bottom",
                            'theme_advanced_resizing' => true,
                        )
                    ))
                    ->add('descriptionAr', 'genemu_tinymce', array(
                        'label' => 'Description Ar',
                        'configs' => array(
                            'add_unload_trigger' => 'false',
                            'remove_linebreaks' => 'true',
                            'inline_styles' => 'true',
                            'convert_fonts_to_spans' => 'true',
                            'elements' => "content_editor",
                            'plugins' => "autolink,lists,spellchecker,pagebreak,table,preview,save,insertdatetime,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking",
                            'theme_advanced_buttons1' => "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                            'theme_advanced_buttons2' => "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,uploads_image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                            'theme_advanced_buttons3' => "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                            'theme_advanced_buttons4' => "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote,pagebreak,|,insertfile,insertimage",
                            'theme_advanced_toolbar_location' => "top",
                            'theme_advanced_toolbar_align' => "left",
                            'theme_advanced_statusbar_location' => "bottom",
                            'theme_advanced_resizing' => true,
                        )
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

            ->tab('Map')
                ->add('latlng', 'oh_google_maps', array())
            ->end()
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array(
                'label' => 'Title En'
            ))
            ->add('titleRu', null, array(
                'label' => 'Title Ru'
            ))
            ->add('titleAr', null, array(
                'label' => 'Title Ar'
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
                'label' => 'Title En'
            ))
            ->add('titleRu', null, array(
                'label' => 'Title Ru'
            ))
            ->add('titleAr', null, array(
                'label' => 'Title Ar'
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
                'label' => 'Title En'
            ))
            ->add('titleRu', null, array(
                'label' => 'Title Ru'
            ))
            ->add('titleAr', null, array(
                'label' => 'Title Ar'
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