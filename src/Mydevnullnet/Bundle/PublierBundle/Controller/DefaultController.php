<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

class DefaultController extends BaseController
{

    public function indexAction()
    {
        return $this->render('MydevnullnetPublierBundle:Default:index.html.twig', array('name' => 'buddy') );
    }

}
