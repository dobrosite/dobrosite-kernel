<?php
/**
 * Система управления сайтами «Добро.сайт»
 *
 * @copyright 2017, Добро.сайт
 * @author    Михаил Красильников <m.krasilnikov@dobro.site>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 */
declare(strict_types=1);

namespace DobroSite\CMS\Kernel;

use Symfony\Component\HttpKernel\KernelInterface as SymfonyKernelInterface;

/**
 * Интерфейс ядра системы.
 *
 * @since 0.1
 */
interface KernelInterface extends SymfonyKernelInterface
{
}
