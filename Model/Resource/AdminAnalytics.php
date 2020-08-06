<?php

namespace Barranco\AdminAnalytics\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AdminAnalytics extends AbstractDb
{
    /**
     * Initialize resource model
     * 
     * @return void
     */
    protected function _construct()
    {
        $this->_init('barranco_admin_analytics', 'id');
    }
}