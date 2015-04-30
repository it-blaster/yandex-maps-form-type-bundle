<?php

namespace Fenrizbes\YandexMapsFormTypeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FenrizbesYandexMapsFormTypeExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->setParameters($container, $config);

        $this->registerResources($container);
    }

    /**
     * Sets parameters
     *
     * @param ContainerBuilder $container
     * @param array $config
     */
    protected function setParameters(ContainerBuilder $container, array $config)
    {
        $container->setParameter('fenrizbes_yamap.size',    $config['size']);
        $container->setParameter('fenrizbes_yamap.default', $config['default']);
    }

    /**
     * Registers form templates
     *
     * @param ContainerBuilder $container
     */
    protected function registerResources(ContainerBuilder $container)
    {
        $templatingEngines = $container->getParameter('templating.engines');

        if (in_array('twig', $templatingEngines)) {
            $container->setParameter('twig.form.resources', array_merge(
                array('FenrizbesYandexMapsFormTypeBundle:Form:fields.html.twig'),
                $container->getParameter('twig.form.resources')
            ));
        }
    }
}
