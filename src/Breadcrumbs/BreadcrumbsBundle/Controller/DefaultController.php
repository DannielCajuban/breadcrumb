<?php

namespace Breadcrumbs\BreadcrumbsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BreadcrumbsBreadcrumbsBundle:Default:sample.html.twig', array('name' => $name));
    }

    public function sampleAction(){
        return $this->render('BreadcrumbsBreadcrumbsBundle:Default:sample.html.twig');
    }

    public function sample2Action(){
        return $this->render('BreadcrumbsBreadcrumbsBundle:Default:sample.html.twig');

    }
    public function blendAction(){
        return $this->render('BreadcrumbsBreadcrumbsBundle:Default:sample.html.twig');

    }


}
