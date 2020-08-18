<?php
/**
 * interface definition:    1' 09" 
 * gets & sets:             2' 57"
 */

namespace Barranco\AdminAnalytics\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface AdminAnalyticsSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get barranco_admin_analytics list
     * 
     * @return Barranco\AdminAnalytics\Api\Data\AdminAnalyticsSearchResultsInterface[]
     */
    public function getItems();

    /**
     * Set barranco_admin_analytics list
     * 
     * @return Barranco\AdminAnalytics\Api\Data\AdminAnalyticsSearchResultsInterface[]
     */
    public function setItems(array $items); 
}