<?php

namespace Barranco\AdminAnalytics\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Barranco\AdminAnalytics\Api\AdminAnalyticsRepositoryInterface;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics as Resource;

class AdminAnalyticsRepository implements AdminAnalyticsRepositoryInterface
{
    /**
     * @var Resource
     */
    protected $resource;

    /**
     * Repository constructor
     * 
     * @param Barranco\AdminAnalytics\Model\Resource\AdminAnalytics $resource
     */
    public function __construct(
        Resource $resource
    ) {
        $this->resource = $resource;
    }

    /**
     * @inheritdoc
     */
    public function save(AdminAnalyticsInterface $adminAnalytics)
    {
        $this->resource->save($adminAnalytics);

        return $adminAnalytics;
    }

    /**
     * 
     */
    public function getById(int $adminAnalyticsId)
    {

    }

    /**
     * 
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {

    }

    /**
     * 
     */
    public function delete(AdminAnalyticsInterface $adminAnalytics)
    {

    }
}