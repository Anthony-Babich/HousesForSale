<?php

namespace House\Bundle\Controller;

use House\Bundle\Form\Search\HouseType as SearchProductsType;
use House\Bundle\Entity\Search\House as SearchProducts;
use House\Bundle\Entity\ContactUS;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductController extends Controller
{
    public function indexAction(string $name)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $searchProducts = new SearchProducts();
        $searchForm = $this->createForm(new SearchProductsType($em), $searchProducts);

        $house = $this->findHouse($name);
        $idType = $house->getIdType()->getId();
        $parameter = $house->getIdSalesRent()->getTitle();
        $slug = $house->getIdType()->getTitle();
        $last = $house->getIdBedrooms()->getTitle();
        $language = $this->get('translator')->getLocale();

        $router = $this->get('router');
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem(
            $this->get('translator')->trans('home', array(), 'messages', $language),
            $router->generate('homepage')
        );
        $breadcrumbs->addItem(
            $this->get('translator')->trans(strtolower($parameter), array(), 'messages', $language),
            $router->generate('parameter', [ 'parameter' => $parameter ])
        );
        $breadcrumbs->addItem(
            $this->get('translator')->trans(strtolower($slug), array(), 'messages', $language),
            $router->generate('secondParameter', [ 'parameter' => $parameter, 'slug' => $slug ])
        );
        $breadcrumbs->addItem(
            $this->get('translator')->trans(strtolower($last), array(), 'messages', $language),
            $router->generate('lastParameter', [ 'parameter' => $parameter, 'slug' => $slug, 'last' => $last ])
        );
        if ($language == 'en') {
            $breadcrumbs->addItem($house->getTitle());
        }elseif ($language == 'ru') {
            $breadcrumbs->addItem($house->getTitleRu());
        }else{
            $breadcrumbs->addItem($house->getTitleAr());
        }

        return $this->render('Product/index.html.twig', array(
            'formContactUS' => $this->getContactUS(),
            'house' => $house,
            'features' => $this->features(),
            //продукт на продажу, аренду - для календаря
            'type' => $parameter,
            'search_form' => $searchForm->createView(),

            'month' => $this->get('translator')->trans(
                'month',
                array(),
                'messages',
                $this->get('translator')->getLocale()
            ),
            'similarProperties' => $this->searchSimilarProperties($idType),

            'address' => $this->getSetting('address'),
            'footerdesc' => $this->getSettingLng('footer-desc'),
            'phones' => $this->getSettingLng('phones'),
            'email' => $this->getSetting('email'),
        ));
    }

    private function findHouse(string $name)
    {
        return $this->getDoctrine()->getManager()->getRepository( 'HouseBundle:House' )
            ->findOneByName( $name );
    }

    private function searchSimilarProperties($idType)
    {
        return $this->getDoctrine()->getManager()->getRepository( 'HouseBundle:House' )
            ->createQueryBuilder('n')
            ->where('n.idType = :type')
            ->setParameter('type', $idType)
            ->setMaxResults(9)
            ->orderBy('n.created', 'DESC')
            ->getQuery()
            ->getResult();
    }

    private function getContactUS()
    {
        $costProject = new ContactUS();

        $language = $this->get('translator')->getLocale();
        $formCostProject = $this->createFormBuilder($costProject)
            ->add('name', TextType::class, array(
                'attr' => [
                    'placeholder' => $this->get('translator')->trans('yourname', array(), 'messages', $language),
                    'class' => 'form-control input-contact-us'
                ],
                'label' => false
            ))
            ->add('email', EmailType::class, array(
                'attr' => [
                    'placeholder' => $this->get('translator')->trans('youremail', array(), 'messages', $language),
                    'class' => 'form-control input-contact-us',
                ],
                'required' => false,
                'label' => false,
            ))
            ->add('phone', NumberType::class, array(
                'attr' => [
                    'class' => 'form-control input-contact-us',
                    'placeholder' => $this->get('translator')->trans('yournumber', array(), 'messages', $language),
                    'type' => 'tel',
                ],
                'label' => false,
            ))
            ->add('message', TextAreaType::class, array(
                'attr' => [
                    'placeholder' => $this->get('translator')->trans('typeyoumessage', array(), 'messages', $language),
                    'class' => 'form-control input-contact-us textarea',
                    'min' => 5,
                    'max' => 999,
                ],
                'label' => false,
            ))
            ->getForm()->createView();

        return $formCostProject;
    }

    private function getSetting($param)
    {
        $res = $this->getDoctrine()->getManager()->getRepository('HouseBundle:Settings')
            ->createQueryBuilder('n')
            ->select('n')
            ->where('n.title = :param')
            ->setParameter('param', $param)
            ->getQuery()
            ->getResult();
        if(empty($res[0])){
            return 'error';
        }else{
            return $res[0]->getSetting();
        }
    }

    private function features(){
        return $this->getDoctrine()->getManager()->getRepository('HouseBundle:House')
            ->createQueryBuilder('n')
            ->select('n')
            ->orderBy('n.created', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    private function getSettingLng($param)
    {
        $trans = $this->get('translator')->getLocale();
        if ($trans == 'ru'){
            $param .= '-ru';
        }elseif ($trans == 'en'){
            $param .= '-en';
        }elseif ($trans == 'ar'){
            $param .= '-ar';
        }
        $res = $this->getDoctrine()->getManager()->getRepository('HouseBundle:Settings')
            ->createQueryBuilder('n')
            ->select('n')
            ->where('n.title = :param')
            ->setParameter('param', $param)
            ->getQuery()
            ->getResult();
        if(empty($res)){
            return 'error';
        }else{
            return $res;
        }
    }
}