<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{

    protected function getParam( $paramName, $defaultValue, $methodName, $isRequired )
    {
        $request = $this->getRequest();

        switch ( $methodName ) {
            case 'get':
                $method = $request->query;
                break;
            case 'post':
                $method = $request->request;
                break;
            default:
                break;
        }

        $param = $method->get( $paramName, $defaultValue );

        if ( $isRequired && $param === null ) {
            throw new \Exception( $paramName . ' is missing' );
        }
        
        return $param;
    }

    /**
     * this magic method gives help us to call the methods:
     *
     * - $this->getGetParam( $paramName, $defaultValue = null )
     * - $this->getPostParam( $paramName, $defaultValue = null )
     * - $this->getRequiredGetParam( $paramName )
     * - $this->getRequiredPostParam( $paramName )
     *
     * Currently it supports only the $_GET and $_POST methods,
     * but we may add support for other methods if we are going
     * to need them ( which we are probably not ).
     *
     * [from php.net] 
     * This method triggers when invoking inaccessible methods in an object context
     *
     */
    public function __call( $method, $args )
    {
        $isRequired = strpos( $method, 'Required' ) !== false;

        if ( strstr( $method, 'Get' ) ) {
            $requestMethodName = 'get';
        }

        if ( strstr( $method, 'Post' ) ) {
            $requestMethodName = 'post';
        }

        return $this->getParam( $args[0], isset( $args[1] ) ? $args[1] : null, $requestMethodName, $isRequired );
    }

}

