<?php

/*
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Dunglas\DoctrineJsonOdm\Tests;

use Dunglas\DoctrineJsonOdm\Tests\Fixtures\AppKernelWithProfiler;
use Symfony\Component\Serializer\Debug\TraceableSerializer;

/**
 * Test profiler integration.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class ProfilerIntegrationTest extends AbstractKernelTestCase
{
    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        self::$class = AppKernelWithProfiler::class;
        parent::setUp();
    }

    public function testSerializerIsDecoratedWithTraceableSerializer(): void
    {
        $serializer = self::$kernel->getContainer()->get('dunglas_doctrine_json_odm.serializer');
        
        $this->assertInstanceOf(TraceableSerializer::class, $serializer, 'The serializer should be decorated with TraceableSerializer when profiler is enabled');
    }

    public function testSerializerDataCollectorIsRegistered(): void
    {
        $this->assertTrue(
            self::$kernel->getContainer()->get('test.service_container')->has('serializer.data_collector'),
            'The serializer data collector should be registered'
        );
    }
}
