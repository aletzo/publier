<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

class ErrorController extends BaseController
{

    public function indexAction()
    {
        return $this->render( 'MydevnullnetPublierBundle:Error:index.html.twig' );
    }

}
