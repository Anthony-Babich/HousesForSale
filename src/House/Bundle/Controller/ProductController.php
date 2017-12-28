<?php

namespace House\Bundle\Controller;

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
        $house = $this->findHouse($name);
        $idType = $house->getIdType()->getId();
        $parameter = $house->getIdSalesRent()->getTitle();
        $slug = $house->getIdType()->getTitle();
        $last = $house->getIdBedrooms()->getTitle();

        $router = $this->get('router');
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Home', $router->generate('homepage'));
        $breadcrumbs->addItem($parameter, $router->generate('parameter', [ 'parameter' => $parameter ]));
        $breadcrumbs->addItem($slug, $router->generate('secondParameter', [ 'parameter' => $parameter, 'slug' => $slug ]));
        $breadcrumbs->addItem($last, $router->generate('lastParameter', [ 'parameter' => $parameter, 'slug' => $slug, 'last' => $last ]));
        $breadcrumbs->addItem($house->getTitle());

        return $this->render('Product/index.html.twig', array(
            'formContactUS' => $this->getContactUS(),
            'house' => $house,
            'features' => $this->features(),
            //продукт на продажу, аренду - для календаря
            'type' => $parameter,

            'similarProperties' => $this->searchSimilarProperties($idType),

            'address' => $this->getSetting('address'),
            'phones' => $this->getPhone('phone'),
            'email' => $this->getSetting('email'),
            'footerdesc' => $this->getSetting('footer-desc'),
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
            ->findByIdType($idType);
    }

    private function getContactUS()
    {
        $costProject = new ContactUS();

        $formCostProject = $this->createFormBuilder($costProject)
            ->add('name', TextType::class, array(
                'attr' => [
                    'placeholder' => 'Your Name',
                    'class' => 'form-control input-contact-us'
                ],
                'label' => false
            ))
            ->add('email', EmailType::class, array(
                'attr' => [
                    'placeholder' => 'Your E-mail',
                    'class' => 'form-control input-contact-us',
                ],
                'required' => false,
                'label' => false,
            ))
            ->add('phone', NumberType::class, array(
                'attr' => [
                    'class' => 'form-control input-contact-us',
                    'placeholder' => 'Your Phone',
                    'type' => 'tel',
                ],
                'label' => false,
            ))
            ->add('message', TextAreaType::class, array(
                'attr' => [
                    'placeholder' => 'Type your message...',
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

    private function getPhone($param)
    {
        $trans = $this->get('translator')->getLocale();
        if ($param == 'phone'){
            if ($trans == 'ru'){
                $param .= '-ru';
            }elseif ($trans == 'en'){
                $param .= '-en';
            }elseif ($trans == 'ar'){
                $param .= '-ar';
            }
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