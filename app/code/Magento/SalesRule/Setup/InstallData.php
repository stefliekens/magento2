<?php
/**
* Copyright © 2015 Magento. All rights reserved.
* See COPYING.txt for license details.
*/

// @codingStandardsIgnoreFile

namespace Magento\SalesRule\Setup;

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
		$installer = $setup->createMigrationSetup();
		$installer->startSetup();
		
		$installer->appendClassAliasReplace(
		    'salesrule',
		    'conditions_serialized',
		    \Magento\Framework\Module\Setup\Migration::ENTITY_TYPE_MODEL,
		    \Magento\Framework\Module\Setup\Migration::FIELD_CONTENT_TYPE_SERIALIZED,
		    ['rule_id']
		);
		$installer->appendClassAliasReplace(
		    'salesrule',
		    'actions_serialized',
		    \Magento\Framework\Module\Setup\Migration::ENTITY_TYPE_MODEL,
		    \Magento\Framework\Module\Setup\Migration::FIELD_CONTENT_TYPE_SERIALIZED,
		    ['rule_id']
		);
		
		$installer->doUpdateClassAliases();
		
		$installer->endSetup();
		
	}
}