<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

class UserController extends BaseController
{

    public function loginAction()
    {
        return $this->render( 'MydevnullnetPublierBundle:User:login.html.twig' );
    }

    public function logoutAction()
    {
        return $this->render( 'MydevnullnetPublierBundle:User:logout.html.twig' );
    }

    public function profileAction()
    {
        return $this->render( 'MydevnullnetPublierBundle:User:profile.html.twig' );
    }

}
