<?php

namespace Barranco\AdminAnalytics\Test\Unit\Model\Resource\AdminAnalytics;

use PHPUnit\Framework\TestCase;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Select;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics as Resource;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics\Collection;

class CollectionTest extends TestCase
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * @var ObjectManager
     */
    private $objectManager;
    
    /**
     * @var AdapterInterface
     */
    private $connection;

    /**
     * @var Select
     */
    private $select;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * Initialize test case
     */
    public function setUp()
    {
        $this->objectManager    = new ObjectManager($this);
        $this->connection       = $this->createMock(AdapterInterface::class);
        $this->select           = $this->createMock(Select::class);
        $this->resource         = $this->getMockForAbstractClass(
                                    Resource::class,
                                    [],
                                    '',
                                    false,
                                    true,
                                    true,
                                    ['getConnection', 'getMainTable', 'getTable']
                                );
        
        $this->connection->expects($this->once())
                            ->method('select')
                            ->willReturn($this->select);

        $this->resource->expects($this->any())
                            ->method('getConnection')
                            ->willReturn($this->connection);

        $this->collection   = $this->objectManager->getObject(
                                Collection::class, [
                                    'resource' => $this->resource
                                ]
                            );
    }

    /**
     * Test Collection class extends AbstractCollection class
     * 
     * @test
     */
    public function testCollectionInstance()
    {
        $this->assertInstanceOf(AbstractCollection::class, $this->collection);
    }
}
