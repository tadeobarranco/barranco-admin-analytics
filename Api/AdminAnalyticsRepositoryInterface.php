<?php
/**
 * interface definition:    00' 49"
 * CRUD methods:            11' 47"
 */

namespace Barranco\AdminAnalytics\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface;

/**
 * barranco_admin_analytics CRUD interface
 * 
 * @api
 */
interface AdminAnalyticsRepositoryInterface
{
    /**
     * Save barranco_admin_analytics row
     * 
     * @param   \Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface $adminAnalytics
     * @return  \Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface
     * @throws  \Magento\Framework\Exception\LocalizedException
     */
    public function save(AdminAnalyticsInterface $adminAnalytics);

    /**
     * Retrieve a row from barranco_admin_analytics
     * 
     * @param   int $adminAnalyticsId
     * @return  \Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface
     * @throws  \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $adminAnalyticsId);

    /**
     * Retrieve a list of rows from barranco_admin_analytics
     * 
     * @param   \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return  \Barranco\AdminAnalytics\Api\Data\AdminAnalyticsSearchResultsInterface
     * @throws  \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete a row from barranco_admin_analytics
     * 
     * @param   \Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface
     * @return  bool true on success
     * @throws  \Magento\Framework\Exception\LocalizedException
     */
    public function delete(AdminAnalyticsInterface $adminAnalytics);
}