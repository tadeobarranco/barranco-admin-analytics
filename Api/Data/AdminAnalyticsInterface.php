<?php
/**
 * interface definition:    0' 39"
 * gets & sets:             7' 20"
 */

namespace Barranco\AdminAnalytics\Api\Data;

/**
 * @api
 */
interface AdminAnalyticsInterface
{
    /**
     * Get barranco_admin_analytics id
     * 
     * @return  null|int
     */
    public function getId(): ?int;

    /**
     * Set barranco_admin_analytics id
     * 
     * @param   int $id
     * @return  Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface
     */
    public function setId(int $id): self;

    /**
     * Get barranco_admin_analytics last_viewed_in_version
     * 
     * @return  null|string
     */
    public function getLastViewedInVersion(): ?string;  

    /**
     * Set barranco_admin_analytics last_viewed_in_version
     * 
     * @param   string $lastViewedInVersion
     * @return  Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface
     */
    public function setLastViewedInVersion(string $lastViewedInVersion): self; 
}