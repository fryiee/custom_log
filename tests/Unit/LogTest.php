<?php

class LogTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!file_exists(__DIR__.'/../logs')) {
            mkdir(__DIR__ . '/../logs');
        }
    }

    public function tearDown()
    {
        if (file_exists(__DIR__.'/../logs/nested')) {
            rmdir(__DIR__ . '/../logs/nested');
        }

        if (file_exists(__DIR__.'/../logs')) {
            rmdir(__DIR__ . '/../logs');
        }
    }

    /** @test */
    public function returnsALoggerInstance()
    {
        $this->assertInstanceOf(
            \Monolog\Logger::class,
            $this->reflectPrivateMethod(new \Fryiee\CustomLog\Log(), 'setup', ['name'])
        );
    }

    /** @test */
    public function checkThatItLogsToFileCorrectly()
    {
        $name = 'test';
        $logPath = __DIR__.'/../logs/'.$name.'.log';
        \Fryiee\CustomLog\Log::info($name, 'Testing a log.');

        $this->assertFileExists($logPath);
        $this->assertNotFalse(strpos(file_get_contents($logPath), $name.'.INFO: Testing a log.'));

        // test will fail before this if does not exist
        unlink($logPath);
    }

    /** @test */
    public function checkThatItLogsToNestedFileCorrectly()
    {
        $name = 'nested/test';
        $logPath = __DIR__.'/../logs/'.$name.'.log';
        \Fryiee\CustomLog\Log::info($name, 'Testing a log.');

        $this->assertFileExists($logPath);
        $this->assertNotFalse(strpos(file_get_contents($logPath), $name.'.INFO: Testing a log.'));

        // test will fail before this if does not exist
        unlink($logPath);
    }

    /**
     * @param $obj
     * @param $name
     * @param array $args
     * @return mixed
     */
    private function reflectPrivateMethod($obj, $name, array $args)
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }
}