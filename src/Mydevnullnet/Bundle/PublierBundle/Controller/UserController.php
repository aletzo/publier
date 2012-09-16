<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

class UserController extends BaseController
{

    public function loginAction()
    {
        if ( $this->get( 'session' )->get( 'is_authed' ) ) {
            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_posts' ) );
        }

        $em = $this->getDoctrine()->getEntityManager();

        if ( $this->getRequest()->getMethod() == 'POST' ) {
            $email         = $this->getRequiredPostParam( 'email' );
            $password      = $this->getRequiredPostParam( 'password' );

            $users = $em->getRepository( 'MydevnullnetPublierBundle:User' )->findAll();

            foreach( $users as $user ) {
                if ( $user->getEmail() == $email
                    && $user->getPassword() == hash( 'whirlpool', $user->getSalt() . 'j1bb3rish' . $password )
                ) {
                    $this->get( 'session' )->set( 'is_authed', true );

                    $site = $em->getRepository( 'MydevnullnetPublierBundle:Site' )
                            ->find( 1 );

                    $this->get( 'session' )->set( 'site_name', $site->getName() );
                    $this->get( 'session' )->set( 'site_domain', $site->getDomain() );

                    return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_posts' ) );
                }
            }
            
            $this->get( 'session' )->getFlashBag()->add( 'error', 'Who are you?' );
        }

        return $this->render( 'MydevnullnetPublierBundle:User:login.html.twig' );
    }

    public function logoutAction()
    {
        if ( ! $this->get( 'session' )->get( 'is_authed' ) ) {
            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_home' ) );
        }

        $this->get( 'session' )->set( 'is_authed', false );

        return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_login' ) );
    }

    public function settingsAction()
    {
        if ( ! $this->get( 'session' )->get( 'is_authed' ) ) {
            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_home' ) );
        }

        $em = $this->getDoctrine()->getEntityManager();

        $site = $em->getRepository( 'MydevnullnetPublierBundle:Site' )->find( 1 );

        $user = $em->getRepository( 'MydevnullnetPublierBundle:User' )->find( 1 );

        if ( $this->getRequest()->getMethod() == 'POST' ) {
            $name          = $this->getRequiredPostParam( 'name' );
            $domain        = $this->getRequiredPostParam( 'domain' );
            $email         = $this->getRequiredPostParam( 'email' );

            $description   = $this->getPostParam( 'description' );
            $useSlags      = $this->getPostParam( 'use_slugs' );

            $oldPassword   = $this->getPostParam( 'old_password' );
            $newPassword   = $this->getPostParam( 'new_password' );

            if ( $oldPassword ) {
                if ( empty ( $newPassword ) ) {
                    $this->get( 'session' )->getFlashBag()->add( 'warning', 'New password is missing!' );

                    return $this->render( 'MydevnullnetPublierBundle:User:settings.html.twig', array(
                        'site' => $site,
                        'user' => $user
                    ) );
                } else {
                    if ( hash( 'whirlpool', $user->getSalt() . 'j1bb3rish' . $oldPassword ) != $user->getPassword() ) {
                        $this->get( 'session' )->getFlashBag()->add( 'error', 'Old password is wrong!' );

                        return $this->render( 'MydevnullnetPublierBundle:User:settings.html.twig', array(
                            'site' => $site,
                            'user' => $user
                        ) );
                    }
                }
            }

            $site->setName( $name )
                ->setDescription( $description )
                ->setDomain( $domain )
                ->setUseSlugs( $useSlags == 'on' );
                
            $em->merge( $site );

            if ( $oldPassword ) {
                $salt = hash( 'whirlpool', uniqid( '', true ) );

                $hashedPassword = hash( 'whirlpool', $salt . 'j1bb3rish' . $newPassword );

                $user->setPassword( $hashedPassword )
                     ->setSalt( $salt );
            }

            $user->setEmail( $email );
                
            $em->merge( $user );

            $em->flush();

            $this->get( 'session' )->set( 'site_name', $site->getName() );
            $this->get( 'session' )->set( 'site_domain', $site->getDomain() );

            $this->get( 'session' )->getFlashBag()->add( 'success', 'Settings saved!' );
        }

        return $this->render( 'MydevnullnetPublierBundle:User:settings.html.twig', array(
            'site' => $site,
            'user' => $user
        ) );
    }

}
