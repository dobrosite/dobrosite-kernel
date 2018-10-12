<?php

/**
 * Система управления сайтами «Добро.сайт»
 *
 * @copyright 2018, Добро.сайт
 * @author    Михаил Красильников <m.krasilnikov@dobro.site>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 */

namespace DobroSite\CMS\Kernel;

use PHPUnit\Framework\TestCase;

/**
 * Тесты ядра сценариев.
 */
class ScriptKernelTest extends TestCase
{
    /**
     * Проверяет создание ядра по умолчанию.
     */
    public function testCreate()
    {
        $kernel = ScriptKernel::getInstance();

        self::assertInstanceOf(ConfigurableKernel::class, $kernel);
        self::assertEquals('prod', $kernel->getEnvironment());
        self::assertFalse($kernel->isDebug());

        self::assertSame($kernel, ScriptKernel::getInstance());
    }

    /**
     * Проверяет создание ядра с заданной конфигурацией.
     */
    public function testCreateWithConfiguration()
    {
        $configuration = $this->createConfiguredMock(
            Configuration::class,
            [
                'getEnvironment' => 'dev',
                'isDebug' => true,
                'getConfigFiles' => []
            ]
        );

        ScriptKernel::setConfiguration($configuration);
        $kernel = ScriptKernel::getInstance();

        self::assertInstanceOf(ConfigurableKernel::class, $kernel);
        self::assertEquals('dev', $kernel->getEnvironment());
        self::assertTrue($kernel->isDebug());
    }

    /**
     * Проверяет установку собственного ядра.
     */
    public function testSetCustomKernel()
    {
        $expectedKernel = $this->createMock(KernelInterface::class);
        ScriptKernel::setKernel($expectedKernel);

        $kernel = ScriptKernel::getInstance();

        self::assertNotInstanceOf(ConfigurableKernel::class, $kernel);
        self::assertSame($expectedKernel, $kernel);
    }

    /**
     * Готовит окружение теста.
     */
    protected function setUp()
    {
        parent::setUp();

        $kernel = new \ReflectionProperty(ScriptKernel::class, 'kernel');
        $kernel->setAccessible(true);
        $kernel->setValue(null);

        $configuration = new \ReflectionProperty(ScriptKernel::class, 'configuration');
        $configuration->setAccessible(true);
        $configuration->setValue(null);
    }
}
