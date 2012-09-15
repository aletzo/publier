<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

class UserController extends BaseController
{

    public function loginAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        if ( $this->getRequest()->getMethod() == 'POST' ) {
            $email         = $this->getRequiredPostParam( 'email' );
            $password      = $this->getRequiredPostParam( 'password' );

            $users = $em->getRepository( 'MydevnullnetPublierBundle:User' )->findAll();

            foreach( $users as $user ) {
                if ( $user->getPassword() == hash( 'whirlpool', $user->getSalt() . 'j1bb3rish' . $password ) ) {
                    return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_profile' ) );
                }
            }
            
            $this->get( 'session' )->getFlashBag()->add( 'error', 'Who are you?' );
        }

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
