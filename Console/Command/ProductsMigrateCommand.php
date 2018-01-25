<?php
namespace MaggyLondon\ProductsMigrate\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MaggyLondon\ProductsMigrate\Block\Product;

Class ProductsMigrateCommand extends Command
{
	private $getProuduct;
	private $appState;


	public function __construct(
		\Magento\Framework\App\State $state
	) 
	{
		// $this->product = $product;
		
		$this->appState = $state;

		parent::__construct();

	}

	protected function configure()
	{
		$this->setName('cp:products');
		$this->setDescription('copy products from exist category to another category');

		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if (!$this->appState->getAreaCode()) {
		  $this->appState->setAreaCode('frontend');
		}
		$this->getProuduct = $this->product();
	
		$output->writeln(count($this->getProuduct()));
		$output->writeln("hey, testing!");
	}

	public function product() 
	{
		if (!$this->appState->getAreaCode()) {
		  $this->appState->setAreaCode('frontend');
		}
		$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();

        $productCollectionFactory = $objectManager->get('\MaggyLondon\ProductsMigrate\Block\ProductFactory');
        $collection = $productCollectionFactory->create();

		$getProuduct = $collection->getProductCollect();
		return $getProuduct;
	}
}