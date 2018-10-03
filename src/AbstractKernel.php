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
     * Путь к папке кэша.
     *
     * @var string|null
     */
    private $cacheDir;

    /**
     * Путь к папке журналов.
     *
     * @var string|null
     */
    private $logDir;

    /**
     * Возвращает путь к папке кэша.
     *
     * @return string
     */
    public function getCacheDir()
    {
        if ($this->cacheDir === null) {
            $this->cacheDir = sys_get_temp_dir().'/'.sha1($this->getRootDir()).'/cache';
        }

        return $this->cacheDir.'/'.$this->getEnvironment();
    }

    /**
     * Возвращает путь к папке журналов.
     *
     * @return string
     */
    public function getLogDir()
    {
        if ($this->logDir === null) {
            $this->logDir = sys_get_temp_dir().'/'.sha1($this->getRootDir()).'/logs';
        }

        return $this->logDir;
    }

    /**
     * Возвращает корневую папку приложения (папку, где лежит файл composer.lock).
     *
     * @return string
     */
    public function getRootDir()
    {
        if ($this->rootDir === null) {
            $this->rootDir = dirname(getcwd().'/'.$_SERVER['PHP_SELF']);
            while (!file_exists($this->rootDir.'/composer.lock')) {
                $parent = \dirname($this->rootDir);
                if ($parent === $this->rootDir) {
                    return $this->rootDir;
                }
                $this->rootDir = $parent;
            }
        }

        return $this->rootDir;
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
     * @since 0.3
     *
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $filenames = $this->getConfigurationFilenames();
        print_r($filenames);
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
        return [
            $this->getRootDir().'/config/services.yaml'
        ];
    }
}
