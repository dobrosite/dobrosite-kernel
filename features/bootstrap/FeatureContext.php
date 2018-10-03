<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;
use Symfony\Component\Process\Process;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Стандартный вывод ошибок.
     *
     * @var string
     */
    private $stderr = '';

    /**
     * Стандартный вывод.
     *
     * @var string
     */
    private $stdout = '';

    /**
     * @When I run command :command
     *
     * @param string $command
     *
     * @return void
     */
    public function iRunCommand($command)
    {
        $process = new Process($command);
        $process->run();
        $this->stdout = $process->getOutput();
        $this->stderr = $process->getErrorOutput();
    }

    /**
     * @Then I should see at stdout:
     *
     * @param PyStringNode $text
     *
     * @return void
     */
    public function iShouldSeeInStdOut(PyStringNode $text)
    {
        $expected = str_replace(
            [
                '{CWD}',
                '{TMP}',
            ],
            [
                getcwd(),
                sys_get_temp_dir()
            ],
            $text->getRaw()
        );
        $expected = preg_replace_callback(
            '/\{SHA1\((.+)\)\}/',
            function (array $match) {
                return sha1($match[1]);
            },
            $expected
        );
        Assert::assertContains($expected, $this->stdout);
    }
}
