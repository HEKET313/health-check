<?php

namespace niklesh\HealthCheckBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

class RoutesLoader extends Loader
{

    /**
     * @inheritdoc
     */
    public function load($resource, $type = null)
    {
        $routes = new RouteCollection();
        $routes->addCollection($this->import(__DIR__ . '/../Resources/config/routes.yaml', 'yaml'));
        return $routes;
    }

    /**
     * @inheritdoc
     */
    public function supports($resource, $type = null)
    {
        return $type === 'health_check';
    }
}
