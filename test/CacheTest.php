<?php
require_once __DIR__ . '/../vendor/autoload.php';
define('APPLICATION_PATH', __DIR__);

class CacheTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    protected $cacheFilePath;
    protected $cacheName;
    
    public function setUp()
    {
    
        $this->bootstrap = new Zend_Application(
            'testing',
            APPLICATION_PATH . '/application.ini'
        );
        
        // Cache name and cache file path are extracted from application.ini,
        // in order to make them available to all test methods.
        $config = $this->bootstrap->getOptions();
        $cacheNames = array_keys($config['resources']['cachemanager']);
        $this->cacheName = $cacheNames[0];
        $this->cacheFilePath = $config['resources']['cachemanager'][$this->cacheName]['backend']['options']['cache_db_complete_path'];
        
        parent::setUp();
        
    }
    
    public function tearDown()
    {
    
        parent::tearDown();
        
        if (file_exists($this->cacheFilePath) === true) {
            unlink($this->cacheFilePath);
        }
        
    }

    /**
     * Ensure cache database file path
     * does not exist before usage
     * and exists after usage.
     */
    public function testCacheFilePathExistence()
    {
    
        $this->assertFileNotExists($this->cacheFilePath);

        $this->_getCache();

        $this->assertFileExists($this->cacheFilePath);
        
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
     * Ensure trying to cache an uncacheable value
     * throws a Zend_Cache_Exception.
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
            ->getCache($this->cacheName);

    }

}
