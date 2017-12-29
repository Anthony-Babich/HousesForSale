<?php

namespace House\Bundle\Controller;

use House\Bundle\Entity\ContactUS;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ParametersController
 * @package House\Bundle\Controller
 * @Route("/{_locale}/search")
 */
class ParametersController extends Controller
{
    /**
     * @Route("/{parameter}/", name="parameter")
     * @param string $parameter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(string $parameter)
    {
        $router = $this->get('router');
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem(
            $this->get('translator')->trans('home', array(), 'messages', $this->get('translator')->getLocale()),
            $router->generate('homepage')
        );
        $breadcrumbs->addItem($this->get('translator')->trans(strtolower($parameter), array(), 'messages', $this->get('translator')->getLocale()));

        return $this->render('Parameter/index.html.twig', array(
            'houses' => $this->searchParameter($parameter),
            'features' => $this->features(),
            'formContactUS' => $this->getContactUS(),

            'newLng' => $this->get('translator')->getLocale(),
            'priceType' => $parameter,
            'head' => $this->get('translator')->trans(strtolower($parameter), array(), 'messages', $this->get('translator')->getLocale()),
            'number' => 0,

            'address' => $this->getSetting('address'),
            'phones' => $this->getPhone('phone'),
            'email' => $this->getSetting('email'),
            'footerdesc' => $this->getSetting('footer-desc'),
        ));
    }

    /**
     * @Route("/{parameter}/{slug}/", name="secondParameter")
     * @param string $parameter
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function secondParameterAction(string $parameter, string $slug)
    {
        $router = $this->get('router');
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem(
            $this->get('translator')->trans('home', array(), 'messages', $this->get('translator')->getLocale()),
            $router->generate('homepage')
        );
        $breadcrumbs->addItem(
            $this->get('translator')->trans(strtolower($parameter), array(), 'messages', $this->get('translator')->getLocale()),
            $router->generate('parameter', [ 'parameter' => $parameter ])
        );
        $breadcrumbs->addItem($this->get('translator')->trans(strtolower($slug), array(), 'messages', $this->get('translator')->getLocale()));

        $head = $this->get('translator')->trans(strtolower($parameter), array(), 'messages', $this->get('translator')->getLocale())
            . ' ' . $this->get('translator')->trans(strtolower($slug), array(), 'messages', $this->get('translator')->getLocale());

        return $this->render('Parameter/index.html.twig', array(
            'houses' => $this->searchSecondParameter($parameter, $slug),
            'features' => $this->features(),
            'formContactUS' => $this->getContactUS(),

            'newLng' => $this->get('translator')->getLocale(),
            'priceType' => $parameter,
            'slug' => $slug,
            'head' => $head,
            'number' => 0,

            'address' => $this->getSetting('address'),
            'phones' => $this->getPhone('phone'),
            'email' => $this->getSetting('email'),
            'footerdesc' => $this->getSetting('footer-desc'),
        ));
    }

    /**
     * @Route("/{parameter}/{slug}/{last}/", name="lastParameter")
     * @param string $parameter
     * @param string $slug
     * @param string $last
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lastParameterAction(string $parameter, string $slug, string $last)
    {
        $router = $this->get('router');
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem(
            $this->get('translator')->trans('home', array(), 'messages', $this->get('translator')->getLocale()),
            $router->generate('homepage')
        );
        $breadcrumbs->addItem(
            $this->get('translator')->trans(strtolower($parameter), array(), 'messages', $this->get('translator')->getLocale()),
            $router->generate('parameter', [ 'parameter' => $parameter ])
        );
        $breadcrumbs->addItem(
            $this->get('translator')->trans(strtolower($slug), array(), 'messages', $this->get('translator')->getLocale()),
            $router->generate('secondParameter', [ 'parameter' => $parameter, 'slug' => $slug ])
        );
        $breadcrumbs->addItem($last);

        $head = $this->get('translator')->trans(strtolower($parameter), array(), 'messages', $this->get('translator')->getLocale())
            . ' ' . $this->get('translator')->trans(strtolower($slug), array(), 'messages', $this->get('translator')->getLocale())
            . ' ' . $this->get('translator')->trans(strtolower($last), array(), 'messages', $this->get('translator')->getLocale());

        return $this->render('Parameter/index.html.twig', array(
            'houses' => $this->searchLastParameter($parameter, $slug, $last),
            'features' => $this->features(),
            'formContactUS' => $this->getContactUS(),

            'newLng' => $this->get('translator')->getLocale(),
            'priceType' => $parameter,
            'slug' => $slug,
            'last' => $last,
            'head' => $head,
            'number' => 0,

            'address' => $this->getSetting('address'),
            'phones' => $this->getPhone('phone'),
            'email' => $this->getSetting('email'),
            'footerdesc' => $this->getSetting('footer-desc'),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loadMoreAjaxAction(Request $request){
        $type = $request->get('type');
        $sale = $request->get('sale');
        $bed = $request->get('bed');
        $offset = $request->get('offset');
        $lang = $request->get('lang');

        if ( isset($_POST['bed']) ){
            $houses = $this->getMoreHouses($offset, $sale, $type, $bed);
        }elseif ( isset($_POST['type']) ){
            $houses = $this->getMoreHouses($offset, $sale, $type);
        }elseif ( isset($_POST['sale']) ){
            $houses = $this->getMoreHouses($offset, $sale);
        }else{
            $houses = $this->getMoreHouses($offset);
        }
        return $this->render('Parameter/productcontainer.html.twig', array(
            'newLng' => $lang,
            'houses' => $houses,
            'priceType' => $sale,
            'number' => 1000,
        ));
    }

    private function getMoreHouses($offset, $sale = null, $type = null, $bed = null)
    {
        $qb = $this->getDoctrine()->getManager()->getRepository('HouseBundle:House')
            ->createQueryBuilder('n')
            ->select('n')
            ->innerJoin('n.idSalesRent', 's')
            ->innerJoin('n.idType', 't')
            ->innerJoin('n.idBedrooms', 'b')
            ->orderBy('n.created', 'DESC')
            ->where('1 = 1');

        if (!is_null($bed)){
            $qb
                ->andWhere('b.bed = :bed')
                ->setParameter('bed', $bed);
        }
        if (!is_null($type)){
            $qb
                ->andWhere('t.title = :type')
                ->setParameter('type', $type);
        }
        if (!is_null($sale)){
            $qb
                ->andWhere('s.title = :sale')
                ->setParameter('sale', $sale);
        }
        return $qb->setFirstResult($offset)
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
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

    private function searchParameter(string $parameter){
        return $this->getDoctrine()->getManager()->getRepository('HouseBundle:House')
            ->createQueryBuilder('n')
            ->select('n')
            ->innerJoin('n.idSalesRent', 's')
            ->orderBy('n.created', 'DESC')
            ->where('s.title = :idFirst')
            ->setParameter('idFirst', $parameter)
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }

    private function searchSecondParameter(string $parameter, string $slug){
        return $this->getDoctrine()->getManager()->getRepository('HouseBundle:House')
            ->createQueryBuilder('n')
            ->select('n')
            ->innerJoin('n.idSalesRent', 's')
            ->innerJoin('n.idType', 't')
            ->orderBy('n.created', 'DESC')
            ->where('s.title = :idFirst')
            ->andWhere('t.title = :idSecond')
            ->setParameters(['idFirst' => $parameter, 'idSecond' => $slug])
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }

    private function searchLastParameter(string $parameter, string $slug, string $last){
        return $this->getDoctrine()->getManager()->getRepository('HouseBundle:House')
            ->createQueryBuilder('n')
            ->select('n')
            ->innerJoin('n.idSalesRent', 's')
            ->innerJoin('n.idType', 't')
            ->innerJoin('n.idBedrooms', 'b')
            ->orderBy('n.created', 'DESC')
            ->where('s.title = :idFirst')
            ->andWhere('t.title = :idSecond')
            ->andWhere('b.title = :idLast')
            ->setParameters(['idFirst' => $parameter, 'idSecond' => $slug, 'idLast' => $last])
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
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
}