<?php

/*
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Dunglas\DoctrineJsonOdm\Tests\Fixtures;

use AppKernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Test kernel with profiler and serializer data collection enabled.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class AppKernelWithProfiler extends AppKernel
{
    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        parent::configureContainer($container, $loader);

        $container->loadFromExtension('framework', [
            'profiler' => [
                'collect' => false,
                'collect_serializer_data' => true,
            ],
        ]);
    }
}
