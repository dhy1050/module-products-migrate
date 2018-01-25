<?php
namespace MaggyLondon\ProductsMigrate\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MaggyLondon\ProductsMigrate\Block\Product;

Class ProductsMigrateCommand extends Command
{
	private $getProuduct;
	// private $state;

	public function __construct(Product $product, \Magento\Framework\App\State $state) 
	{
		$this->getProuduct = $product;
		$state->setAreaCode('frontend');
	}

	protected function configure()
	{
		$this->setName('cp:products');
		$this->setDescription('copy products from exist category to another category');

		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		 // required for repository functionality
        // $this->state->setAreaCode(
        //     \Magento\Framework\App\Area::GLOBAL
        // );
     
		$output->writeln("hey, testing!");
	}
}