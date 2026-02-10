<?php

/*
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Dunglas\DoctrineJsonOdm\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Serializer\Debug\TraceableSerializer;

final class SerializerProfilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->getParameter('kernel.debug')) {
            return;
        }

        if (!$container->hasDefinition('serializer.data_collector')) {
            return;
        }

        if (!$container->hasDefinition('dunglas_doctrine_json_odm.serializer')) {
            return;
        }

        $container->register('debug.dunglas_doctrine_json_odm.serializer', TraceableSerializer::class)
            ->setDecoratedService('dunglas_doctrine_json_odm.serializer')
            ->setArguments([
                new Reference('debug.dunglas_doctrine_json_odm.serializer.inner'),
                new Reference('serializer.data_collector'),
                'dunglas_doctrine_json_odm',
            ])
        ;
    }
}
