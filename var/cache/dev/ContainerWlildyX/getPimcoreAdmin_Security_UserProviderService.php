<?php

namespace ContainerWlildyX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPimcoreAdmin_Security_UserProviderService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'pimcore_admin.security.user_provider' shared autowired service.
     *
     * @return \Pimcore\Bundle\AdminBundle\Security\User\UserProvider
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-core/User/UserProviderInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/pimcore/pimcore/bundles/AdminBundle/Security/User/UserProvider.php';

        return $container->services['pimcore_admin.security.user_provider'] = new \Pimcore\Bundle\AdminBundle\Security\User\UserProvider();
    }
}
