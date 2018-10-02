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
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Тесты основы ядра приложения.
 */
class AbstractKernelTest extends TestCase
{
    /**
     * Метод registerBundles должен возвращать пустой массив.
     */
    public function testRegisterBundlesEmptyArray()
    {
        $kernel = $this->getMockForAbstractClass(AbstractKernel::class, ['dev', true]);

        self::assertEquals([], $kernel->registerBundles());
    }

    /**
     * По умолчанию метод registerContainerConfiguration не должен регистрировать ничего.
     */
    public function testRegisterContainerConfigurationDefault()
    {
        $loader = $this->createMock(LoaderInterface::class);
        $loader->expects(self::never())->method('load');

        $kernel = $this->getMockForAbstractClass(AbstractKernel::class, ['dev', true]);
        $kernel->registerContainerConfiguration($loader);
    }
}
