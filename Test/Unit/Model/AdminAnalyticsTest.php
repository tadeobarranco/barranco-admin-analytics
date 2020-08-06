<?php

namespace Barranco\AdminAnalytics\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface;
use Barranco\AdminAnalytics\Model\AdminAnalytics;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics as Resource;

class AdminAnalyticsTest extends TestCase
{
    /**
     * @var AdminAnalytics
     */
    private $model;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * Initialize test
     */
    protected function setUp()
    {
        $this->objectManager    = new ObjectManager($this);
        $this->resource         = $this->createMock(Resource::class);
        
        $this->model            = $this->objectManager->getObject(
                                    AdminAnalytics::class,
                                    [
                                        'resource' => $this->resource
                                    ]
                                );
    }

    /**
     * Test AdminAnalytics extends from AbstractModel
     * 
     * @test
     */
    public function testExtendsAbstractModel()
    {
        $this->assertInstanceOf(AbstractModel::class, $this->model);
    }

    /**
     * Test AdminAnalytics implements AdminAnalyticsInterface
     * 
     * @test
     */
    public function testImplementsInterface()
    {
        $this->assertInstanceOf(AdminAnalyticsInterface::class, $this->model);
    }

    /**
     * Test AdminAnalytics _construct init right resource class
     * 
     * @test
     */
    public function testResourceName()
    {
        $this->assertEquals($this->model->getResourceName(), get_class($this->resource));
    }
}