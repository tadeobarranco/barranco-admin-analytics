<?php

namespace Barranco\AdminAnalytics\Model;

use Magento\Framework\Model\AbstractModel;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterface;

class AdminAnalytics extends AbstractModel implements AdminAnalyticsInterface
{

    /**
     * Initialize resource model
     * 
     * @return void
     */
    public function _construct()
    {
        $this->_init(Barranco\AdminAnalytics\Model\Resource\AdminAnalytics::class);
    }
    
    /**
     * @inheritdoc
     */
    public function getAdminAnalyticsId(): ?int
    {
        return $this->getData('id');
    }

    /**
     * @inheritdoc
     */
    public function setAdminAnalyticsId(int $id): AdminAnalyticsInterface
    {
        $this->setData('id', $id);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLastViewedInVersion(): ?string
    {
        return $this->getData('last_viewed_in_version');
    }

    /**
     * @inheritdoc
     */
    public function setLastViewedInVersion(string $lastViewedInVersion): AdminAnalyticsInterface
    {
        $this->setData('last_viewed_in_version', $lastViewedInVersion);

        return $this;
    }
}