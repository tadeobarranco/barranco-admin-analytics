<?php

namespace Barranco\AdminAnalytics\Model\Resource\AdminAnalytics;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Barranco\AdminAnalytics\Model\AdminAnalytics;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics as Resource;

class Collection extends AbstractCollection
{
    /**
     * Initialize collection
     */
    public function _construct()
    {
        $this->_init(AdminAnalytics::class, Resource::class);
    }
}
