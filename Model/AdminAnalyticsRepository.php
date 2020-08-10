<?php

namespace Barranco\AdminAnalytics\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Barranco\AdminAnalytics\Api\AdminAnalyticsRepositoryInterface;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterfaceFactory;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics as Resource;

class AdminAnalyticsRepository implements AdminAnalyticsRepositoryInterface
{
    /**
     * @var Resource
     */
    protected $resource;

    /**
     * @var AdminAnalyticsInterfaceFactory
     */
    protected $factory;

    /**
     * Repository constructor
     * 
     * @param Barranco\AdminAnalytics\Model\Resource\AdminAnalytics $resource
     * @param Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterfaceFactory $factory
     */
    public function __construct(
        Resource $resource,
        AdminAnalyticsInterfaceFactory $factory
    ) {
        $this->resource = $resource;
        $this->factory  = $factory;
    }

    /**
     * @inheritdoc
     */
    public function save(AdminAnalyticsInterface $adminAnalytics)
    {
        try {
            $this->resource->save($adminAnalytics); 
        } catch(\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        } 

        return $adminAnalytics;
    }

    /**
     * @inheritdoc
     */
    public function getById(int $adminAnalyticsId)
    {
        $model = $this->factory->create();

        $this->resource->load($model, $adminAnalyticsId);

        return $model;
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