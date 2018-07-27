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
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;

/**
 * Ядро системы.
 *
 * @since 0.1
 */
class Kernel extends SymfonyKernel implements KernelInterface
{
    /**
     * Путь к папке конфигурации приложения.
     *
     * @var string|null
     */
    private $configDir;

    /**
     * Шаблон имени главного файла конфигурации.
     *
     * @var string
     */
    private $configFileTemplate = 'config.%s.yaml';

    /**
     * Конфигурация ядра.
     *
     * @var Configuration
     */
    private $configuration;

    /**
     * Путь к корневой папке приложения.
     *
     * @var string|null
     */
    private $projectDir;

    /**
     * Создаёт ядро.
     *
     * Аргумент $configuration главным образом нужен при встраивании ядра в другую систему, чтобы
     * описать её конфигурацию.
     *
     * @param string        $environment   Имя окружения.
     * @param bool          $debug         Управление режимом отладки.
     * @param Configuration $configuration Конфигурация ядра.
     *
     * @since 0.1
     */
    public function __construct($environment, $debug, Configuration $configuration = null)
    {
        parent::__construct($environment, $debug);

        $this->configuration = $configuration ?: new Configuration();

        if ($this->configuration->getProjectDir() !== null) {
            $this->projectDir = $this->configuration->getProjectDir();
        }
        if ($this->configuration->getConfigDir() !== null) {
            $this->configDir = $this->configuration->getConfigDir();
        }
        if ($this->configuration->getConfigFileTemplate() !== null) {
            $this->configFileTemplate = $this->configuration->getConfigFileTemplate();
        }
        $this->rootDir = $this->getProjectDir();
    }

    /**
     * Возвращает путь к папке настроек.
     *
     * @return string
     *
     * @since 0.1
     */
    public function getConfigDir()
    {
        if ($this->configDir === null) {
            $this->configDir = $this->getRootDir().'/app/config';
        }

        return $this->configDir;
    }

    /**
     * Возвращает корневую папку приложения (папку, где лежит composer.lock).
     *
     * @return string
     *
     * @since 0.1
     */
    public function getProjectDir()
    {
        if ($this->projectDir === null) {
            $r = new \ReflectionObject($this);
            $dir = $rootDir = dirname($r->getFileName());
            while (!file_exists($dir.'/composer.lock')) {
                if ($dir === dirname($dir)) {
                    return $this->projectDir = $rootDir;
                }
                $dir = dirname($dir);
            }
            $this->projectDir = $dir;
        }

        return $this->projectDir;
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
     *
     * @throws \Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $filename = sprintf($this->configFileTemplate, $this->getEnvironment());
        $loader->load($this->getConfigDir().'/'.$filename);

        foreach ($this->configuration->getExtraConfigFiles() as $filename) {
            $loader->load($filename);
        }
    }

    /**
     * Возвращает параметры ядра.
     *
     * @return array
     */
    protected function getKernelParameters()
    {
        return array_merge(
            array(
                'kernel.config_dir' => $this->getConfigDir(),
            ),
            parent::getKernelParameters()
        );
    }
}
