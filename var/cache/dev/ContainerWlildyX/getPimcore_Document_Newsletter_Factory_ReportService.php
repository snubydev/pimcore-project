<?php

namespace ContainerWlildyX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPimcore_Document_Newsletter_Factory_ReportService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'pimcore.document.newsletter.factory.report' shared autowired service.
     *
     * @return \Pimcore\Document\Newsletter\ReportAddressSourceAdapterFactory
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/pimcore/pimcore/lib/Document/Newsletter/AddressSourceAdapterFactoryInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/pimcore/pimcore/lib/Document/Newsletter/ReportAddressSourceAdapterFactory.php';

        return $container->privates['pimcore.document.newsletter.factory.report'] = new \Pimcore\Document\Newsletter\ReportAddressSourceAdapterFactory(($container->services['pimcore.custom_report.adapter.factories'] ?? $container->load('getPimcore_CustomReport_Adapter_FactoriesService')));
    }
}
