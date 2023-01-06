<?php

namespace ContainerWlildyX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getSecurity_Firewall_Map_Context_PimcoreAdminService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'security.firewall.map.context.pimcore_admin' shared service.
     *
     * @return \Symfony\Bundle\SecurityBundle\Security\FirewallContext
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-bundle/Security/FirewallContext.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Util/TargetPathTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Firewall/ExceptionListener.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Firewall/LogoutListener.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-bundle/Security/FirewallConfig.php';

        $a = ($container->services['.container.private.security.token_storage'] ?? $container->get_Container_Private_Security_TokenStorageService());
        $b = ($container->privates['security.http_utils'] ?? $container->getSecurity_HttpUtilsService());
        $c = ($container->privates['Pimcore\\Bundle\\AdminBundle\\Security\\Authenticator\\AdminLoginAuthenticator'] ?? $container->load('getAdminLoginAuthenticatorService'));

        if (isset($container->privates['security.firewall.map.context.pimcore_admin'])) {
            return $container->privates['security.firewall.map.context.pimcore_admin'];
        }
        $d = ($container->privates['security.event_dispatcher.pimcore_admin'] ?? $container->load('getSecurity_EventDispatcher_PimcoreAdminService'));

        if (isset($container->privates['security.firewall.map.context.pimcore_admin'])) {
            return $container->privates['security.firewall.map.context.pimcore_admin'];
        }

        return $container->privates['security.firewall.map.context.pimcore_admin'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['security.channel_listener'] ?? $container->load('getSecurity_ChannelListenerService'));
            yield 1 => ($container->privates['debug.security.firewall.authenticator.pimcore_admin'] ?? $container->load('getDebug_Security_Firewall_Authenticator_PimcoreAdminService'));
            yield 2 => ($container->privates['security.authentication.access_listener.two_factor.pimcore_admin'] ?? $container->load('getSecurity_Authentication_AccessListener_TwoFactor_PimcoreAdminService'));
            yield 3 => ($container->privates['security.access_listener'] ?? $container->load('getSecurity_AccessListenerService'));
        }, 4), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, ($container->privates['scheb_two_factor.security.authentication.trust_resolver'] ?? $container->getSchebTwoFactor_Security_Authentication_TrustResolverService()), $b, 'pimcore_admin', $c, NULL, NULL, ($container->services['monolog.logger.security'] ?? $container->getMonolog_Logger_SecurityService()), true), new \Symfony\Component\Security\Http\Firewall\LogoutListener($a, $b, $d, ['csrf_parameter' => '_csrf_token', 'csrf_token_id' => 'logout', 'logout_path' => 'pimcore_admin_logout']), new \Symfony\Bundle\SecurityBundle\Security\FirewallConfig('pimcore_admin', 'security.user_checker', '.security.request_matcher.2aAPAae', true, true, 'Pimcore\\Bundle\\AdminBundle\\Security\\User\\UserProvider', NULL, 'Pimcore\\Bundle\\AdminBundle\\Security\\Authenticator\\AdminLoginAuthenticator', NULL, NULL, [0 => 'login_throttling', 1 => 'two_factor', 2 => 'Pimcore\\Bundle\\AdminBundle\\Security\\Authenticator\\AdminLoginAuthenticator', 3 => 'Pimcore\\Bundle\\AdminBundle\\Security\\Authenticator\\AdminTokenAuthenticator', 4 => 'Pimcore\\Bundle\\AdminBundle\\Security\\Authenticator\\AdminSessionAuthenticator'], NULL));
    }
}
