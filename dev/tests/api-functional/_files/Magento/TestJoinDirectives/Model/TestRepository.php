<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\TestJoinDirectives\Model;

use Magento\TestJoinDirectives\Api\TestRepositoryInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

/**
 * Model TestRepository
 */
class TestRepository implements TestRepositoryInterface
{
    /**
     * @var \Magento\Quote\Model\Resource\Quote\CollectionFactory
     */
    private $quoteCollectionFactory;

    /**
     * @var \Magento\Quote\Api\Data\CartSearchResultsInterfaceFactory
     */
    private $searchResultsDataFactory;

    /**
     * @var JoinProcessorInterface
     */
    private $extensionAttributesJoinProcessor;

    /**
     * @param \Magento\Quote\Model\Resource\Quote\CollectionFactory $quoteCollectionFactory
     * @param \Magento\Quote\Api\Data\CartSearchResultsInterfaceFactory $searchResultsDataFactory
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        \Magento\Quote\Model\Resource\Quote\CollectionFactory $quoteCollectionFactory,
        \Magento\Quote\Api\Data\CartSearchResultsInterfaceFactory $searchResultsDataFactory,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->quoteCollectionFactory = $quoteCollectionFactory;
        $this->searchResultsDataFactory = $searchResultsDataFactory;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(\Magento\Framework\Api\SearchCriteria $searchCriteria)
    {
        $quoteCollection = $this->quoteCollectionFactory->create();
        $this->extensionAttributesJoinProcessor->process($quoteCollection);
        $searchData = $this->searchResultsDataFactory->create();
        $searchData->setSearchCriteria($searchCriteria);
        $searchData->setItems($quoteCollection->getItems());
        return $searchData;
    }
}
