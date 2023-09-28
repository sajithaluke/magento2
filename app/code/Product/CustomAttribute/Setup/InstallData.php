<?php
namespace Product\CustomAttribute\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $categorySetupFactory;

    public function __construct(CategorySetupFactory $categorySetupFactory)
    {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);

        $categorySetup->addAttribute(
            Product::ENTITY,
            'style',
            
            [
                'type' => 'int',
                'label' => 'Style',
                'input' => 'select',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Table',
                'required' => false,
                'sort_order' => 100,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'used_in_product_listing' => true,
                'user_defined' => true,
                'apply_to' => ''
            ]
        );

        // Assign options for the dropdown
        $options = [
            'freestyle',
            'formal',
            'casual'
        ];

        foreach ($options as $value) {
            $categorySetup->addAttributeOption([
                'attribute_id' => $categorySetup->getAttributeId(Product::ENTITY, 'style'),
                'value' => [
                    'option' => [$value, $value]
                ]
            ]);
        }
    }
}