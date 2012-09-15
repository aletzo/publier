<?php

namespace Mydevnullnet\Bundle\PublierBundle\Controller;

use Symfony\Component\Finder\Finder,
    Symfony\Component\HttpFoundation\Response;


class DataController extends BaseController
{

    public function purgeallAction()
    {
        try { 
            echo 'I empty all the db tables that have a corresponding file inside the .src/Mydevnullnet/Bundle/PublierBundle/Entity directory.<br><br>';

            $em = $this->getDoctrine()
                       ->getEntityManager();

            $entitiesDir = $this->get( 'kernel' )->getRootDir() . '/../src/Mydevnullnet/Bundle/PublierBundle/Entity';


            $finder = new Finder();
            $finder->files()
                   ->in( $entitiesDir );

            foreach ( $finder as $file ) {
                $filename = $file->getRelativePathname();

                if ( strpos( $filename, '~' )        // get rid of the back up files
                    || strpos( $filename, 'Entity' ) // get rid of the BaseEntity file
                ) {
                    continue;
                }

                $entity = substr( $filename, 0, -4 );

                $this->truncateTable( $em, $entity );
            }

            echo '<br>The database tables are now empty.';
        } catch ( Exception $e ) {
            echo $e->getMessage();
        }

        return new Response();
    }

    protected function truncateTable( $em, $className )
    {
        $cmd = $em->getClassMetadata( '\Mydevnullnet\Bundle\PublierBundle\Entity\\' . $className );
        $connection = $em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->beginTransaction();

        try {
            $connection->executeUpdate( $dbPlatform->getTruncateTableSql( $cmd->getTableName() ) );
            $connection->commit();

            echo 'truncated table ' . $cmd->getTableName() . '<br>';
        } catch ( \Exception $e ) {
            echo 'FAILED: truncated table ' . $cmd->getTableName() . '<br>';
            echo $e->getMessage() . '<br>';
            $connection->rollback();
        }

        return $this;
    }

}
