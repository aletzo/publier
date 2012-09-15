<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

use Mydevnullnet\Bundle\PublierBundle\Entity\Site,
    Mydevnullnet\Bundle\PublierBundle\Entity\User;

class SetupController extends BaseController
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        if ( $this->getRequest()->getMethod() == 'POST' ) {
            $name          = $this->getRequiredPostParam( 'name' );
            $domain        = $this->getRequiredPostParam( 'domain' );
            $email         = $this->getRequiredPostParam( 'email' );
            $password      = $this->getRequiredPostParam( 'password' );

            $site = new Site();

            $site->setName( $name )
                 ->setDescription( $this->getPostParam( 'description' ) )
                 ->setDomain( $domain );
            
            $em->persist( $site );

            $salt = hash( 'whirlpool', uniqid( '', true ) );

            $hashedPassword = hash( 'whirlpool', $salt . 'j1bb3rish' . $password );

            $user = new User();

            $user->setEmail( $email )
                 ->setPassword( $hashedPassword )
                 ->setSalt( $salt );
            
            $em->persist( $user );

            $em->flush();

            $this->get( 'session' )->getFlashBag()->add( 'success', 'The site is now set up! Log in dude!' );

            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_login' ) );
        }

        return $this->render( 'MydevnullnetPublierBundle:Setup:index.html.twig' );
    }

}
