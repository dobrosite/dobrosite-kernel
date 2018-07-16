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

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;

/**
 * Ядро системы.
 *
 * @since 0.1
 */
class Kernel extends SymfonyKernel implements KernelInterface
{
    /**
     * Создаёт ядро.
     *
     * @param string $environment Имя окружения.
     * @param bool   $debug       Управление режимом отладки.
     *
     * @since 0.1
     */
    public function __construct($environment, $debug)
    {
        parent::__construct($environment, $debug);
        $this->rootDir = $this->getProjectDir();
    }

    /**
     * Возвращает массив пакетов, которые надо зарегистрировать в ядре.
     *
     * @return BundleInterface[]
     *
     * @since 0.1
     */
    public function registerBundles()
    {
        return [];
    }

    /**
     * Загружает конфигурацию контейнера.
     *
     * @param LoaderInterface $loader Загрузчик конфигурации.
     *
     * @since 0.1
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}
