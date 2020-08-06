<?php

namespace Barranco\AdminAnalytics\Test\Unit\Model\Resource;

use PHPUnit\Framework\TestCase;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics;

class AdminAnalyticsTest extends TestCase
{
    
    /**
     * @var AdminAnalytics
     */
    private $resource;

    /**
     * @var Context
     */
    private $context;

    /**
     * Initialize test class
     */
    protected function setUp()
    {
        $this->context  = $this->createMock(Context::class);
        $this->resource = new AdminAnalytics(
                            $this->context
                        );
    }

    /**
     * Test Resource extends AbstractDb
     * 
     * @test
     */
    public function testExtendsAbstractDb()
    {
        $this->assertInstanceOf(AbstractDb::class, $this->resource);
    }
    
}