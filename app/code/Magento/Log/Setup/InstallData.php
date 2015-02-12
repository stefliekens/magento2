<?php
/**
* Copyright © 2015 Magento. All rights reserved.
* See COPYING.txt for license details.
*/

// @codingStandardsIgnoreFile

namespace Magento\Log\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataResourceInterface;

class InstallData implements InstallDataInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function install(ModuleDataResourceInterface $setup, ModuleContextInterface $context)
	{
		$installer = $setup;
		
		$data = [
		    ['type_id' => 1, 'type_code' => 'hour', 'period' => 1, 'period_type' => 'HOUR'],
		    ['type_id' => 2, 'type_code' => 'day', 'period' => 1, 'period_type' => 'DAY'],
		];
		
		foreach ($data as $bind) {
		    $installer->getConnection()->insertForce($installer->getTable('log_summary_type'), $bind);
		}
		
	}
}