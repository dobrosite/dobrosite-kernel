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
    protected $cacheDir;

    /**
     * Путь к папке конфигурации приложения.
     *
     * @var string|null
     */
    protected $configDir;

    /**
     * Путь к папке журналов.
     *
     * @var string|null
     */
    protected $logDir;

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
     * Возвращает путь к папке настроек.
     *
     * @return string
     *
     * @since 0.3
     */
    public function getConfigDir()
    {
        if ($this->configDir === null) {
            $this->configDir = $this->getRootDir().'/config';
        }

        return $this->configDir;
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
        print_r($filenames); die;
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
        if ($this->getEnvironment() === 'prod') {
            $path = $this->getConfigDir().'/config.yaml';
        } else {
            $path = $this->getConfigDir().'/config_'.$this->getEnvironment().'.yaml';
        }

        if (file_exists($path)) {
            return [$path];
        }

        return [];
    }

    /**
     * Возвращает параметры ядра.
     *
     * @return array
     *
     * @since 0.4
     */
    protected function getKernelParameters()
    {
        return array_merge(
            [
                'kernel.config_dir' => $this->getConfigDir(),
            ],
            parent::getKernelParameters()
        );
    }
}
