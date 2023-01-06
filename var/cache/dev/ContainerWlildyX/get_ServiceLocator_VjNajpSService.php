<?php

namespace ContainerWlildyX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_VjNajpSService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.VjNajpS' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.VjNajpS'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'eventDispatcher' => ['services', 'event_dispatcher', 'getEventDispatcherService', false],
            'localeService' => ['services', 'Pimcore\\Localization\\LocaleServiceInterface', 'getLocaleServiceInterfaceService', false],
        ], [
            'eventDispatcher' => '?',
            'localeService' => 'Pimcore\\Localization\\LocaleServiceInterface',
        ]);
    }
}
