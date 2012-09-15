<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

class PostController extends BaseController
{

    public function listAction()
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:list.html.twig' );
    }

    public function loadAction( $slug )
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:load.html.twig' );
    }

    public function newAction()
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:new.html.twig' );
    }

    public function editAction( $slug )
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:edit.html.twig' );
    }

    public function publishAction( $slug )
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:publish.html.twig' );
    }

    public function archiveAction( $slug )
    {
        return $this->render( 'MydevnullnetPublierBundle:Post:archive.html.twig' );
    }

}
