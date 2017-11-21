<?php
require_once __DIR__ . '/../vendor/autoload.php';
// https://framework.zend.com/manual/1.11/en/zend.test.phpunit.db.html
// WHY PHPUnit ^5.0: https://stackoverflow.com/questions/6065730/why-fatal-error-class-phpunit-framework-testcase-not-found-in/42561590#42561590
class CacheTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        // Assign and instantiate in one step:
        $this->bootstrap = new Zend_Application(
            'testing',
            __DIR__ . '/application.ini'
        );
        parent::setUp();
    }

    public function testCache() {
        $cacheManager = $this->bootstrap
            ->getBootstrap()
            ->getPluginResource('cachemanager')
            ->getCacheManager();
        $userAgentCache = $cacheManager->getCache('cachename');
        $response = $userAgentCache->load('aaa');
        $userAgentCache->save($response, 'aaa');
    }

}
