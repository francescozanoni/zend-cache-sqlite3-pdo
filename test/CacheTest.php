<?php
// https://framework.zend.com/manual/1.11/en/zend.test.phpunit.db.html
class CacheTest extends Zend_Test_PHPUnit_DatabaseTestCase
{
    private $_connectionMock;
 
    /**
     * Returns the test database connection.
     *
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        if($this->_connectionMock == null) {
            $connection = Zend_Db::factory(...);
            $this->_connectionMock = $this->createZendDbConnection(
                $connection, 'zfunittests'
            );
            Zend_Db_Table_Abstract::setDefaultAdapter($connection);
        }
        return $this->_connectionMock;
    }
 
    public function testBugInsertedIntoDatabase()
    {
        $bugsTable = new Bugs();
 
        $data = array(
            'created_on'      => '2007-03-22 00:00:00',
            'updated_on'      => '2007-03-22 00:00:00',
            'bug_description' => 'Something wrong',
            'bug_status'      => 'NEW',
            'reported_by'     => 'garfield',
            'verified_by'     => 'garfield',
            'assigned_to'     => 'mmouse',
        );
 
        $bugsTable->insert($data);
 
        $ds = new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet(
            $this->getConnection()
        );
        $ds->addTable('zfbugs', 'SELECT * FROM zfbugs');
 
        $this->assertDataSetsEqual(
            $this->createFlatXmlDataSet(dirname(__FILE__)
                                      . "/_files/bugsInsertIntoAssertion.xml"),
            $ds
        );
    }
    
}