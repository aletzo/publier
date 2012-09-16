<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

use Mydevnullnet\Bundle\PublierBundle\Entity\Site,
    Mydevnullnet\Bundle\PublierBundle\Entity\User;

class SiteController extends BaseController
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $em->getRepository( 'MydevnullnetPublierBundle:User' )
                   ->find( 1 );

        if ( ! $user ) {
            $this->get( 'session' )->getFlashBag()->add( 'info', 'The site is not installed yet. What are you waiting for?' );

            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_install' ) );
        } else {
            return $this->forward( 'MydevnullnetPublierBundle:Post:list' );
        }
    }

    public function installAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $em->getRepository( 'MydevnullnetPublierBundle:User' )
                   ->find( 1 );
        if ( $user ) {
            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_home' ) );
        }

        if ( $this->getRequest()->getMethod() == 'POST' ) {
            $name          = $this->getRequiredPostParam( 'name' );
            $domain        = $this->getRequiredPostParam( 'domain' );
            $email         = $this->getRequiredPostParam( 'email' );
            $password      = $this->getRequiredPostParam( 'password' );
            $useSlags      = $this->getPostParam( 'use_slugs' );

            $site = new Site();

            $site->setName( $name )
                 ->setDescription( $this->getPostParam( 'description' ) )
                 ->setDomain( $domain )
                 ->setUseSlugs( $useSlags == 'on' );
            
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

        return $this->render( 'MydevnullnetPublierBundle:Site:install.html.twig' );
    }

    public function postsAction()
    {
        if ( ! $this->get( 'session' )->get( 'is_authed' ) ) {
            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_home' ) );
        }
        
        $em = $this->getDoctrine()->getEntityManager();

        $posts = $em->getRepository( 'MydevnullnetPublierBundle:Post' )
                    ->findBy(
                        array(),
                        array( 'publish_date' => 'DESC' )
                    );

        return $this->render( 'MydevnullnetPublierBundle:Site:posts.html.twig', array(
            'posts' => $posts
        ) );
    }

}
