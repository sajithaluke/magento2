<?php

namespace Cronnn\Crontsk\Cron;

use Psr\Log\LoggerInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder; // Add this use statement


class OutOfStock
{
    protected $logger;
    protected $productRepository;
    protected $stockRegistry;
    protected $searchCriteriaBuilder; // Add this property

    public function __construct(
        LoggerInterface $logger,
        ProductRepositoryInterface $productRepository,
        StockRegistryInterface $stockRegistry,
        SearchCriteriaBuilder $searchCriteriaBuilder // Add this argument
    ) {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
        $this->stockRegistry = $stockRegistry;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder; // Assign the argument to the property
    }

    public function execute()
    {
        // Get all products
        $products = $this->productRepository->getList($this->searchCriteriaBuilder->create());

        foreach ($products->getItems() as $product) {
            $productId = $product->getId();

            // Get stock item for the product
            $stockItem = $this->stockRegistry->getStockItem($productId);

            // Check if the product is out of stock
            if (!$stockItem->getIsInStock()) {
                $productName = $product->getName();
                $this->logger->info("Product '$productName' (ID: $productId) is out of stock.");
            }
        }
    }
}