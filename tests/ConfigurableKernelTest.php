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
 * Тесты конфигурируемого ядра.
 *
 * @coversDefaultClass \DobroSite\CMS\Kernel\ConfigurableKernel
 */
class ConfigurableKernelTest extends TestCase
{
    /**
     * Проверяет значения по умолчанию.
     */
    public function testDefaults()
    {
        $kernel = new ConfigurableKernel();

        $rootDir = dirname(__DIR__);

        self::assertEquals('prod', $kernel->getEnvironment());
        self::assertFalse($kernel->isDebug());
        self::assertEquals($rootDir, $kernel->getRootDir());
        self::assertRegExp('~[a-f0-9]{32}/cache/prod$~', $kernel->getCacheDir());
        self::assertRegExp('~[a-f0-9]{32}/logs$~', $kernel->getLogDir());
        self::assertEquals($rootDir.'/config', $kernel->getConfigDir());
    }

    /**
     * Проверяет использование конфигурации.
     */
    public function testConfiguration()
    {
        $rootDir = dirname(__DIR__);

        $configuration = new Configuration();
        $configuration
            ->setEnvironment('test')
            ->enableDebug()
            ->setCacheDir($rootDir.'/cache')
            ->setLogDir($rootDir.'/logs')
            ->setConfigDir($rootDir.'/etc');

        $kernel = new ConfigurableKernel($configuration);

        self::assertEquals('test', $kernel->getEnvironment());
        self::assertTrue($kernel->isDebug());
        self::assertEquals($rootDir, $kernel->getRootDir());
        self::assertEquals($rootDir.'/cache/test', $kernel->getCacheDir());
        self::assertEquals($rootDir.'/logs', $kernel->getLogDir());
        self::assertEquals($rootDir.'/etc', $kernel->getConfigDir());
    }
}
