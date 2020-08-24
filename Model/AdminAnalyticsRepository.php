<?php

namespace Barranco\AdminAnalytics\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\LocalizedException;
use Barranco\AdminAnalytics\Api\AdminAnalyticsRepositoryInterface;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterfaceFactory;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsSearchResultsInterfaceFactory as SearchResultsInterfaceFactory;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics as Resource;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics\CollectionFactory;

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
     * @var SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Repository constructor
     * 
     * @param Barranco\AdminAnalytics\Model\Resource\AdminAnalytics $resource
     * @param Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterfaceFactory $factory
     */
    public function __construct(
        Resource $resource,
        AdminAnalyticsInterfaceFactory $factory,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory
    ) {
        $this->resource             = $resource;
        $this->factory              = $factory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor  = $collectionProcessor;
        $this->collectionFactory    = $collectionFactory;
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

        try {
            $this->resource->load($model, $adminAnalyticsId);
        } catch(\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        try {
            $searchResults  = $this->searchResultsFactory->create();
            $collection     = $this->collectionFactory->create();

            $this->collectionProcessor->process($searchCriteria, $collection);

            $searchResults->setSearchCriteria($searchCriteria);
            $searchResults->setTotalCount($collection->getSize());
            $searchResults->setItems($collection->getItems());
        } catch(\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }

        return $searchResults;
    }

    /**
     * 
     */
    public function delete(AdminAnalyticsInterface $adminAnalytics)
    {

    }
}