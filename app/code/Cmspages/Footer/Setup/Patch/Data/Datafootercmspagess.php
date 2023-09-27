<?php
namespace Cmspages\Footer\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Psr\Log\LoggerInterface;


class Datafootercmspagess implements DataPatchInterface, PatchVersionInterface
{
    /**
    * @var ModuleDataSetupInterface
    */
    private $_moduleDataSetup;

    /**
    * @var PageFactory
    */
    private $_pageFactory;

    /**
     * @var PageRepositoryInterface
     */
    private $_pageRepository;
    private $logger;


    /**
    * @param ModuleDataSetupInterface $moduleDataSetup
    * @param PageFactory $pageFactory
    * @param PageRepositoryInterface $pageRepository
    */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory,
        PageRepositoryInterface $pageRepository,
        LoggerInterface $logger

    ) {
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_pageFactory = $pageFactory;
        $this->_pageRepository = $pageRepository;
        $this->logger = $logger;

    }

    /**
    * {@inheritdoc}
    */
    public function apply()
    {
        $this->logger->info("Patch is being executed...");
        $this->_moduleDataSetup->startSetup();
    
        /* Save CMS Page logic */
        $page = $this->_pageFactory->create();
        $page->setTitle('Cms Page Display in Footer Link2')
             ->setIdentifier('cms-footer-displayed2')
             ->setIsActive(true)
             ->setPageLayout('1column')
            ->setContent('<div style="text-align: center; margin: 0 auto; max-width: 600px;">
            <img src="{{view url=Cmspages_Footer/images/images.jpeg}}"  alt="Cmspage Image" style="display: block; margin: 0 auto;">
            <p style="color:red;">Cms Page in Footer</p>
        </div>');

        $this->_pageRepository->save($page);
    
        // Assign the CMS page to the default store
        $page->setStoreId([0]);
        $this->_pageRepository->save($page);
    
        $this->_moduleDataSetup->endSetup();
        $this->logger->info("Patch execution completed!");

    }
    

    /**
    * {@inheritdoc}
    */
    public static function getDependencies()
    {
        return [];
    }

    /**
    * {@inheritdoc}
    */
    public static function getVersion()
    {
        return '2.4.6';
    }

    /**
    * {@inheritdoc}
    */
    public function getAliases()
    {
        return [];
    }
}
?>