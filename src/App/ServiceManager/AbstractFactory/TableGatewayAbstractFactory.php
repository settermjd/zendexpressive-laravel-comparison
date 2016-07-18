<?php
namespace App\ServiceManager\AbstractFactory;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\Feature;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TableGatewayAbstractFactory implements AbstractFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var Adapter $dbAdapter */
        $dbAdapter = $container->get(Adapter::class);
        $tableGateway = null;

        switch ($requestedName) {
            case ('UrlsTableGateway'):
                $tableGateway = new TableGateway(
                    'urls',
                    $dbAdapter,
                    [
                        new RowGatewayFeature('id')
                    ]
                );
                break;
        }

        return $tableGateway;
    }

    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return fnmatch('*TableGateway', $requestedName);
    }

    public function canCreateServiceWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName
    ) {
        return fnmatch('*TableGateway', $requestedName);
    }

    public function createServiceWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName
    ) {
        /** @var Adapter $dbAdapter */
        $dbAdapter = $serviceLocator->get(Adapter::class);
        $tableGateway = null;

        switch ($requestedName) {
            case ('UrlsTableGateway'):
                $tableGateway = new TableGateway(
                    'urls',
                    $dbAdapter,
                    [
                        new RowGatewayFeature('id')
                    ]
                );
                break;
        }

        return $tableGateway;
    }
}
