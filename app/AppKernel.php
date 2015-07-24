<?php

use Sensio\Bundle\DistributionBundle\SensioDistributionBundle;
use Symfony\Bundle\AsseticBundle\AsseticBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Trismegiste\DokudokiBundle\TrismegisteDokudokiBundle;
use Trismegiste\OAuthBundle\TrismegisteOAuthBundle;
use Trismegiste\PortalBundle\TrismegistePortalBundle;

class AppKernel extends Kernel
{

    final public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new SecurityBundle(),
            new TwigBundle(),
            new MonologBundle(),
            new AsseticBundle(),
            new TrismegisteDokudokiBundle(),
            new TrismegisteOAuthBundle(),
            new TrismegistePortalBundle()
        ];

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new WebProfilerBundle();
            $bundles[] = new SensioDistributionBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->rootDir . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
