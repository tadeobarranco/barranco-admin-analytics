<?php
/**
 * class test definition:   1' 32"
 * default setUp:           1' 27"
 */

namespace Barranco\AdminAnalytics\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Barranco\AdminAnalytics\Model\AdminAnalyticsRepository;
use Barranco\AdminAnalytics\Api\AdminAnalyticsRepositoryInterface;

class AdminAnalyticsRepositoryTest extends TestCase
{
    /**
     * @var AdminAnalyticsRepository
     */
    private $repository;

    /**
     * Initialize test
     */
    protected function setUp()
    {
        $this->repository = new AdminAnalyticsRepository();
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
}