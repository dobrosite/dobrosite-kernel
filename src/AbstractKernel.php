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

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Основа для класса ядра приложения.
 *
 * @since 0.3
 */
abstract class AbstractKernel extends Kernel implements KernelInterface
{
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
     * @since 0.3
     *
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $filenames = $this->getConfigurationFilenames();
        foreach ($filenames as $filename) {
            $loader->load($filename);
        }
    }

    /**
     * Возвращает имена (включая путь) конфигурационных файлов.
     *
     * @return string[]
     *
     * @since 0.3
     */
    protected function getConfigurationFilenames()
    {
        return [];
    }
}
