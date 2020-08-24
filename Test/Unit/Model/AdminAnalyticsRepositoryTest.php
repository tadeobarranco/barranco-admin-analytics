<?php
/**
 * class test definition:       01' 32"
 * default setUp:               01' 27"
 * testRepositoryInstance:      06' 22"
 * testSave:                    41' 06"
 * testSaveWithException:       07' 51"
 * testGetById:                 13' 28"
 * testGetList:                 48' 09"
 * testGetListWithException(s): 20' 01"
 */

namespace Barranco\AdminAnalytics\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Barranco\AdminAnalytics\Api\AdminAnalyticsRepositoryInterface;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsInterfaceFactory;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsSearchResultsInterface;
use Barranco\AdminAnalytics\Api\Data\AdminAnalyticsSearchResultsInterfaceFactory as SearchResultsInterfaceFactory;
use Barranco\AdminAnalytics\Model\AdminAnalytics;
use Barranco\AdminAnalytics\Model\AdminAnalyticsRepository;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics as Resource;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics\Collection;
use Barranco\AdminAnalytics\Model\Resource\AdminAnalytics\CollectionFactory;

class AdminAnalyticsRepositoryTest extends TestCase
{
    /**
     * @var AdminAnalyticsRepository
     */
    private $repository;

    /**
     * @var AdminAnalytics
     */
    private $model;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * @var AdminAnalyticsInterfaceFactory
     */
    private $factory;

    /**
     * @var SearchCriteriaInterface
     */
    private $searchCriteria;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var SearchResultsInterface
     */
    private $searchResults;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var Collection
     */
    private $collection;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * Initialize test
     */
    protected function setUp()
    {
        $this->model                = $this->createMock(AdminAnalytics::class);
        $this->resource             = $this->createMock(Resource::class);
        $this->factory              = $this->createMock(AdminAnalyticsInterfaceFactory::class);
        $this->searchCriteria       = $this->createMock(SearchCriteriaInterface::class);
        $this->searchResultsFactory = $this->createMock(SearchResultsInterfaceFactory::class);
        $this->searchResults        = $this->createMock(AdminAnalyticsSearchResultsInterface::class);
        $this->collectionProcessor  = $this->createMock(CollectionProcessorInterface::class);
        $this->collection           = $this->createMock(Collection::class);
        $this->collectionFactory    = $this->createMock(CollectionFactory::class);

        $this->repository   = new AdminAnalyticsRepository(
                                $this->resource,
                                $this->factory,
                                $this->searchResultsFactory,
                                $this->collectionProcessor,
                                $this->collectionFactory
                            );
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

    /**
     * Test AdminAnalyticsRepository::save 
     * 
     * @test
     */
    public function testSave()
    {
        $this->resource->expects($this->once())
                        ->method('save')
                        ->with($this->model)
                        ->willReturnSelf();

        $this->assertEquals($this->model, $this->repository->save($this->model));
    }

    /**
     * Test AdminAnalyticsRepository::save managing exception
     * 
     * @test
     */
    public function testSaveWithException()
    {
        $this->resource->expects($this->once())
                        ->method('save')
                        ->with($this->model)
                        ->willThrowException(new \Exception());

        $this->expectException(LocalizedException::class);

        $this->repository->save($this->model);
    }

    /**
     * Test AdminAnalyticsRepository::getById
     *
     * @test
     * @dataProvider idsList
     */
    public function testGetById($id)
    {
        $this->factory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->model);

        $this->resource->expects($this->once())
                        ->method('load')
                        ->with($this->model, $id)
                        ->willReturnSelf();

        $this->assertEquals($this->model, $this->repository->getById($id));
    }

    /**
     * Test AdminAnalyticsRepository::getById managing exception
     *
     * @test
     * @dataProvider idsList
     */
    public function testGetByIdWithException($id)
    {
        $this->factory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->model);

        $this->resource->expects($this->once())
                        ->method('load')
                        ->with($this->model, $id)
                        ->willThrowException(new \Exception());

        $this->expectException(LocalizedException::class);

        $this->repository->getById($id);
    }

    /**
     * Test AdminAnalyticsRepository::getList
     *
     * @test
     * @dataProvider collectionList
     */
    public function testGetList($total, $items)
    {
        $this->searchResultsFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->searchResults);

        $this->collectionFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->collection);

        $this->collectionProcessor->expects($this->once())
                        ->method('process')
                        ->with($this->searchCriteria, $this->collection)
                        ->willReturnSelf();

        $this->searchResults->expects($this->once())
                        ->method('setSearchCriteria')
                        ->with($this->searchCriteria)
                        ->willReturnSelf();

        $this->collection->expects($this->once())
                        ->method('getSize')
                        ->willReturn($total);

        $this->searchResults->expects($this->once())
                        ->method('setTotalCount')
                        ->with($total)
                        ->willReturnSelf();

        $this->collection->expects($this->once())
                        ->method('getItems')
                        ->willReturn($items);

        $this->searchResults->expects($this->once())
                        ->method('setItems')
                        ->with($items)
                        ->willReturnSelf();

        $this->assertEquals($this->searchResults, $this->repository->getList($this->searchCriteria));
    }

    /**
     * Test AdminAnalyticsRepository::getList with Excpetion in the SearchResultsFactory object
     *
     * @test
     */
    public function testGetListWithExceptionInSearchResultsFactory()
    {
        $this->searchResultsFactory->expects($this->once())
                        ->method('create')
                        ->willThrowException(new \Exception());

        $this->expectException(LocalizedException::class);

        $this->repository->getList($this->searchCriteria);
    }

    /**
     * Test AdminAnalyticsRepository::getList with Exception in the CollectionFactory object
     *
     * @test
     */
    public function testGetListWithExceptionInCollectionFactory()
    {
        $this->collectionFactory->expects($this->once())
                        ->method('create')
                        ->willThrowException(new \Exception);

        $this->expectException(LocalizedException::class);

        $this->repository->getList($this->searchCriteria);
    }

    /**
     * Test AdminAnalyticsRepository::getList with Exception in the CollectionProcessor process method
     *
     * @test
     */
    public function testGetListWithExceptionInCollectionProcessor()
    {
        $this->collectionFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->collection);

        $this->collectionProcessor->expects($this->once())
                        ->method('process')
                        ->with($this->searchCriteria, $this->collection)
                        ->willThrowException(new \Exception);

        $this->expectException(LocalizedException::class);

        $this->repository->getList($this->searchCriteria);
    }

    /**
     * Test AdminAnalyticsRepository::getList with Exception in the setSearchCriteria method
     *
     * @test
     */
    public function testGetListWithExceptionInSetSearchCriteria()
    {
        $this->searchResultsFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->searchResults);

        $this->collectionFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->collection);

        $this->collectionProcessor->expects($this->once())
                        ->method('process')
                        ->with($this->searchCriteria, $this->collection)
                        ->willReturnSelf();

        $this->searchResults->expects($this->once())
                        ->method('setSearchCriteria')
                        ->with($this->searchCriteria)
                        ->willThrowException(new \Exception);

        $this->expectException(LocalizedException::class);

        $this->repository->getList($this->searchCriteria);
    }

    /**
     * Test AdminAnalyticsRepository::getList with Exception in the setTotalCount method
     *
     * @test
     * @dataProvider collectionList
     */
    public function testGetListWithExceptionInSetTotalCount($total, $items)
    {
        $this->searchResultsFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->searchResults);

        $this->collectionFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->collection);

        $this->collectionProcessor->expects($this->once())
                        ->method('process')
                        ->with($this->searchCriteria, $this->collection)
                        ->willReturnSelf();

        $this->collection->expects($this->once())
                        ->method('getSize')
                        ->willReturn($total);

        $this->searchResults->expects($this->once())
                        ->method('setTotalCount')
                        ->with($total)
                        ->willThrowException(new \Exception);

        $this->expectException(LocalizedException::class);

        $this->repository->getList($this->searchCriteria);
    }

    /**
     * Test AdminAnalyticsRepository::getList with Exception in the setTotalCount method
     *
     * @test
     * @dataProvider collectionList
     */
    public function testGetListWithExceptionInSetItems($total, $items)
    {
        $this->searchResultsFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->searchResults);

        $this->collectionFactory->expects($this->once())
                        ->method('create')
                        ->willReturn($this->collection);

        $this->collectionProcessor->expects($this->once())
                        ->method('process')
                        ->with($this->searchCriteria, $this->collection)
                        ->willReturnSelf();

        $this->collection->expects($this->once())
                        ->method('getItems')
                        ->willReturn($items);

        $this->searchResults->expects($this->once())
                        ->method('setItems')
                        ->with($items)
                        ->willThrowException(new \Exception);

        $this->expectException(LocalizedException::class);

        $this->repository->getList($this->searchCriteria);
    }


    /**
     * Data provider for IDs
     *
     * @return array
     */
    public function idsList()
    {
        return [
            ['123']
        ];
    }

    /**
     * @return array
     */
    public function collectionList()
    {
        return [
            [10, []]
        ];
    }
}