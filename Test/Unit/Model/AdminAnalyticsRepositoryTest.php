<?php
/**
 * class test definition:   01' 32"
 * default setUp:           01' 27"
 * testRepositoryInstance:  06' 22"
 * testSave:                41' 06"
 * testSaveWithException:   07' 51"
 */

namespace Barranco\AdminAnalytics\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Magento\Framework\Exception\LocalizedException;
use Barranco\AdminAnalytics\Api\AdminAnalyticsRepositoryInterface;
use Barranco\AdminAnalytics\Model\AdminAnalytics;
use Barranco\AdminAnalytics\Model\AdminAnalyticsRepository;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics as Resource;

class AdminAnalyticsRepositoryTest extends TestCase
{
    /**
     * @var AdminAnalyticsRepository
     */
    private $repository;

    /**
     * @var AdminAnalytics
     */
    private $model;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * Initialize test
     */
    protected function setUp()
    {
        $this->model        = $this->createMock(AdminAnalytics::class);
        $this->resource     = $this->createMock(Resource::class);

        $this->repository   = new AdminAnalyticsRepository(
                                $this->resource
                            );
    }

    /**
     * Test AdminAnalyticsRepository implements AdminAnalyticsRepositoryInterface
     * 
     * @test 
     */
    public function testRepositoryInstance()
    {
        $this->assertInstanceOf(AdminAnalyticsRepositoryInterface::class, $this->repository);
    }

    /**
     * Test AdminAnalyticsRepository::save 
     * 
     * @test
     */
    public function testSave()
    {
        $this->resource->expects($this->once())
                        ->method('save')
                        ->with($this->model)
                        ->willReturnSelf();

        $this->assertEquals($this->model, $this->repository->save($this->model));
    }

    /**
     * Test AdminAnalyticsRepository::save managing exception
     * 
     * @test
     */
    public function testSaveWithException()
    {
        $this->resource->expects($this->once())
                        ->method('save')
                        ->with($this->model)
                        ->willThrowException(new \Exception());

        $this->expectException(LocalizedException::class);

        $this->repository->save($this->model);
    }
}