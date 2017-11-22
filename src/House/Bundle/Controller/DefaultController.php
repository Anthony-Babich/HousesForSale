<?php

namespace House\Bundle\Controller;

use House\Bundle\Entity\ContactUS;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('homepage/index.html.twig', array(
            'formContactUS' => $this->getContactUS(),
            'address' => $this->getSetting('address'),
            'phones' => $this->getPhone('phone'),
            'email' => $this->getSetting('email'),
            'footerdesc' => $this->getSetting('footer-desc'),
            'homeDescTop' => $this->getSetting('home-desc-top'),
            'houses' => $this->getHouses(['Buy', 'Rent']),
            'priceType' => 'Buy',
        ));
    }

    public function ajaxAction(Request $request){
        $types = $request->get('type');
        $type = explode(",", $types);
        return $this->render('homepage/productcontainer.html.twig', array(
            'houses' => $this->getHouses($type),
            'priceType' => $type[0],
        ));
    }

    public function loadMoreAjaxAction(Request $request){
        $types = $request->get('type');
        $offset = $request->get('offset');
        $type = explode(",", $types);
        return $this->render('homepage/productcontainer.html.twig', array(
            'houses' => $this->getMoreHouses($type, $offset),
            'priceType' => $type[0],
        ));
    }

    public function contactAction()
    {
        return $this->render('contact/index.html.twig', array(
            'formContactUS' => $this->getContactUS(),
            'address' => $this->getSetting('address'),
            'phones' => $this->getPhone('phone'),
            'email' => $this->getSetting('email'),
            'footerdesc' => $this->getSetting('footer-desc'),
            'contactusdesc' => $this->getSetting('contactus-desc'),
        ));
    }

    private function getContactUS()
    {
        $costProject = new ContactUS();

        $formCostProject = $this->createFormBuilder($costProject)
            ->add('name', TextType::class, array(
                'attr' => [
                    'placeholder' => 'Your Name',
                    'class' => 'form-control'
                ],
                'label' => false
            ))
            ->add('email', EmailType::class, array(
                'attr' => [
                    'placeholder' => 'Your E-mail',
                    'class' => 'form-control',
                ],
                'required' => false,
                'label' => false,
            ))
            ->add('phone', NumberType::class, array(
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Your Phone',
                    'type' => 'tel',
                ],
                'label' => false,
            ))
            ->add('message', TextAreaType::class, array(
                'attr' => [
                    'placeholder' => 'Type your message...',
                    'class' => 'form-control',
                ],
                'label' => false,
            ))
            ->getForm()->createView();

        return $formCostProject;
    }

    private function getHouses(array $type)
    {
        return $this->getDoctrine()->getManager()->getRepository('HouseBundle:House')
            ->createQueryBuilder('n')
            ->select('n')
            ->innerJoin('n.idSalesRent', 't')
            ->orderBy('n.created', 'DESC')
            ->where('t.title IN (:type)')
            ->setParameters(array('type' => $type))
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }

    private function getMoreHouses(array $type, $offset)
    {
        if (count($type) == 2){
            return $this->getDoctrine()->getManager()->getRepository('HouseBundle:House')
                ->createQueryBuilder('n')
                ->select('n')
                ->orderBy('n.created', 'DESC')
                ->setFirstResult($offset)
                ->setMaxResults($offset + 6)
                ->getQuery()
                ->getResult();
        }else{
            return $this->getDoctrine()->getManager()->getRepository('HouseBundle:House')
                ->createQueryBuilder('n')
                ->select('n')
                ->innerJoin('n.idSalesRent', 't')
                ->orderBy('n.created', 'DESC')
                ->where('t.title IN (:type)')
                ->setParameters(array('type' => $type))
                ->setFirstResult($offset)
                ->setMaxResults(6)
                ->getQuery()
                ->getResult();
        }
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
//    private function getFormSearch()
//    {
//        $costProject = new ContactUS();
//
//        $formCostProject = $this->createFormBuilder($costProject)
//            ->add('name', TextType::class, array(
//                'attr' => [
//                    'placeholder' => 'Your Name',
//                    'class' => 'form-control'
//                ],
//                'label' => false
//            ))
//            ->add('email', EmailType::class, array(
//                'attr' => [
//                    'placeholder' => 'Your E-mail',
//                    'class' => 'form-control',
//                ],
//                'required' => false,
//                'label' => false,
//            ))
//            ->add('phone', NumberType::class, array(
//                'attr' => [
//                    'class' => 'form-control',
//                    'placeholder' => 'Your Phone',
//                    'type' => 'tel',
//                ],
//                'label' => false,
//            ))
//            ->add('message', TextAreaType::class, array(
//                'attr' => [
//                    'placeholder' => 'Type your message...',
//                    'class' => 'form-control',
//                ],
//                'label' => false,
//            ))
//            ->getForm()->createView();
//
//        return $formCostProject;
//    }
}
