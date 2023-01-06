<?php

namespace ContainerWlildyX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCsvService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'Pimcore\Routing\Redirect\Csv' shared autowired service.
     *
     * @return \Pimcore\Routing\Redirect\Csv
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/pimcore/pimcore/lib/Routing/Redirect/Csv.php';

        return $container->privates['Pimcore\\Routing\\Redirect\\Csv'] = new \Pimcore\Routing\Redirect\Csv();
    }
}
