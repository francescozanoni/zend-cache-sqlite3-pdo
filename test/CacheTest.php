<?php
require_once __DIR__ . '/../vendor/autoload.php';

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

    /**
     * Ensure an uncached item is not available.
     */
    public function testUncachedItem()
    {

        $cache = $this->_getCache();

        $uncachedItemValue = $cache->load('uncached_item_key');

        $this->assertFalse($uncachedItemValue);

    }

    /**
     * Ensure a cached item is available.
     */
    public function testCachedItem()
    {

        $cache = $this->_getCache();

        $cache->save('cached_item_value', 'cached_item_key');
        $cachedItemValue = $cache->load('cached_item_key');

        $this->assertEquals('cached_item_value', $cachedItemValue);

    }

    /**
     * Ensure trying to cache an uncacheable value throws a Zend_Cache_Exception.
     */
    public function testUncacheableItem()
    {

        $cache = $this->_getCache();

        try {

            $cache->save(true, 'uncacheable_item_key');

        } catch (Exception $e) {

            $this->assertInstanceOf('Zend_Cache_Exception', $e);
            $this->assertEquals(
                'Datas must be string or set automatic_serialization = true',
                $e->getMessage()
            );

        }

    }

    /**
     * @return Zend_Cache_Core
     */
    protected function _getCache()
    {

        return $this->bootstrap
            ->getBootstrap()
            ->getPluginResource('cachemanager')
            ->getCacheManager()
            ->getCache('cachename');

    }

}
