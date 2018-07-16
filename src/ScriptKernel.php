<?php

/**
 * Система управления сайтами «Добро.сайт»
 *
 * @copyright 2017, Добро.сайт
 * @author    Михаил Красильников <m.krasilnikov@dobro.site>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 */

namespace DobroSite\CMS\Kernel;

use DobroSite\CMS\Kernel\Exception\LogicException;
use Psr\Container\ContainerInterface;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Обёртка для использования ядра системы в сценариях.
 *
 * Этот класс позволяет сценариям легко поучить доступ к рабочему ядру.
 *
 * Пример:
 *
 * ```php
 * require 'vendor/autoload.php';
 * $kernel = new ScriptKernel();
 * $kernel->getContainer()->get('foo.bar')->…
 * ```
 *
 * @since 0.1
 */
class ScriptKernel implements KernelInterface
{
    /**
     * Ядро системы.
     *
     * @var Kernel
     */
    private $kernel;

    /**
     * Создаёт новое ядро.
     *
     * @param string $environment Имя окружения. По умолчанию «prod».
     * @param bool   $debug       Управление режимом отладки.
     *
     * @since 0.1
     */
    public function __construct($environment = 'prod', $debug = false)
    {
        $this->kernel = $this->createKernel($environment, $debug);
    }

    public function boot()
    {
        $this->methodCanNotBeExecuted('Kernel::boot');
    }

    public function getBundle($name, $first = true)
    {
        $this->kernel->boot();
        return $this->kernel->getBundle($name, $first);
    }

    public function getBundles()
    {
        $this->kernel->boot();
        return $this->kernel->getBundles();
    }

    public function getCacheDir()
    {
        return $this->kernel->getCacheDir();
    }

    public function getCharset()
    {
        return $this->kernel->getCharset();
    }

    /**
     * Возвращает контейнер зависимостей.
     *
     * @return ContainerInterface
     *
     * @since 0.1
     */
    public function getContainer()
    {
        $this->kernel->boot();
        return $this->kernel->getContainer();
    }

    public function getEnvironment()
    {
        return $this->kernel->getEnvironment();
    }

    public function getLogDir()
    {
        return $this->kernel->getLogDir();
    }

    public function getName()
    {
        return $this->kernel->getName();
    }

    public function getRootDir()
    {
        return $this->kernel->getRootDir();
    }

    public function getStartTime()
    {
        return $this->kernel->getStartTime();
    }

    /**
     * @throws LogicException
     *
     * @since 0.1
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        $this->kernel->boot();
        $this->methodCanNotBeExecuted('Kernel::handle');
    }

    public function isDebug()
    {
        return $this->kernel->isDebug();
    }

    public function locateResource($name, $dir = null, $first = true)
    {
        $this->kernel->boot();
        return $this->kernel->locateResource($name, $dir, $first);
    }

    public function registerBundles()
    {
        $this->methodCanNotBeExecuted('Kernel::registerBundles');
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $this->methodCanNotBeExecuted('Kernel::registerContainerConfiguration');
    }

    public function serialize()
    {
        $this->methodCanNotBeExecuted('Kernel::serialize');
    }

    public function shutdown()
    {
        $this->methodCanNotBeExecuted('Kernel::shutdown');
    }

    public function unserialize($serialized)
    {
        $this->methodCanNotBeExecuted('Kernel::unserialize');
    }

    /**
     * Создаёт новое ядро.
     *
     * @param string $environment Имя окружения.
     * @param bool   $debug       Управление режимом отладки.
     *
     * @return KernelInterface
     *
     * @since 0.1
     */
    protected function createKernel($environment, $debug)
    {
        return new Kernel($environment, $debug);
    }

    /**
     * Вбрасывает исключение для методов, недоступных в режиме сценария.
     *
     * @param string $method Имя метода.
     *
     * @throws LogicException
     */
    private function methodCanNotBeExecuted($method)
    {
        throw new LogicException(
            sprintf('Method "%s()" can not be executed in the script mode', $method)
        );
    }
}
