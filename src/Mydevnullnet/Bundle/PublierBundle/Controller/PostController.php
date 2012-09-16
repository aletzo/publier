<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

use Mydevnullnet\Bundle\PublierBundle\Entity\Post,
    Mydevnullnet\Bundle\PublierBundle\Entity\Site,
    Mydevnullnet\Bundle\PublierBundle\Entity\User;

class PostController extends BaseController
{

    public function streamAction()
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:stream.html.twig' );
    }

    public function menuAction()
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:menu.html.twig' );
    }

    public function loadAction( $id )
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:load.html.twig' );
    }

    public function newAction()
    {
        if ( ! $this->get( 'session' )->get( 'is_authed' ) ) {
            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_home' ) );
        }

        $em = $this->getDoctrine()->getEntityManager();

        $site = $em->getRepository( 'MydevnullnetPublierBundle:Site' )
                   ->find( 1 );

        if ( $this->getRequest()->getMethod() == 'POST' ) {
            $title = $this->getRequiredPostParam( 'title' );
            $body  = $this->getRequiredPostParam( 'body' );

            $slug        = $this->getPostParam( 'slug' );
            $publishDate = $this->getPostParam( 'publish_date' );
            $inStream    = $this->getPostParam( 'in_stream' );
            $inMenu      = $this->getPostParam( 'in_menu' );

            $post = new Post();

            $post->setTitle( $title )
                 ->setBody( $body )
                 ->setSlug( $slug ? $slug : $em->getRepository( 'MydevnullnetPublierBundle:Post' )->generateSlug( $title ) )
                 ->setInStream( $inStream == 'on' )
                 ->setPublishDate( new \DateTime( $publishDate ) )
                 ->setCreatedAt( new \DateTime() )
                 ->setInMenu( $inMenu == 'on' );
            
            $em->persist( $post );

            $em->flush();

            $this->get( 'session' )->getFlashBag()->add( 'success', 'New Post created!' );

            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_posts' ) );
        }

        return $this->render( 'MydevnullnetPublierBundle:Post:new.html.twig', array(
            'site' => $site
        ) );
    }

    public function editAction( $id )
    {
        if ( ! $this->get( 'session' )->get( 'is_authed' ) ) {
            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_home' ) );
        }

        $em = $this->getDoctrine()->getEntityManager();

        $site = $em->getRepository( 'MydevnullnetPublierBundle:Site' )
                   ->find( 1 );

        $postRepository = $em->getRepository( 'MydevnullnetPublierBundle:Post' );

        $post = $postRepository->find( $id );

        if ( $this->getRequest()->getMethod() == 'POST' ) {
            $title = $this->getRequiredPostParam( 'title' );
            $body  = $this->getRequiredPostParam( 'body' );

            $slug        = $this->getPostParam( 'slug' );
            $publishDate = $this->getPostParam( 'publish_date' );
            $inStream    = $this->getPostParam( 'in_stream' );
            $inMenu      = $this->getPostParam( 'in_menu' );

            $post->setTitle( $title )
                 ->setBody( $body )
                 ->setSlug( $slug ? $slug : $postRepository->generateSlug( $title, $id ) )
                 ->setPublishDate( new \DateTime( $publishDate ) )
                 ->setInStream( $inStream == 'on' )
                 ->setInMenu( $inMenu == 'on' );
            
            $em->merge( $post );

            $em->flush();

            $this->get( 'session' )->getFlashBag()->add( 'success', 'Post saved!' );

            return $this->redirect( $this->generateUrl( 'mydevnullnet_publier_posts' ) );
        }

        return $this->render( 'MydevnullnetPublierBundle:Post:edit.html.twig', array(
            'post' => $post,
            'site' => $site
        ) );
    }

}
