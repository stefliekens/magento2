<?php
/**
* Copyright © 2015 Magento. All rights reserved.
* See COPYING.txt for license details.
*/

// @codingStandardsIgnoreFile

namespace Magento\UrlRewrite\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleSchemaResourceInterface;

class InstallSchema implements InstallSchemaInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function install(ModuleSchemaResourceInterface $setup, ModuleContextInterface $context)
	{
		$installer = $setup;
		
		$installer->startSetup();
		
		/**
		 * Create table 'url_rewrite'
		 */
		$table = $installer->getConnection()
		    ->newTable($installer->getTable('url_rewrite'))
		    ->addColumn(
		        'url_rewrite_id',
		        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
		        null,
		        ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
		        'Rewrite Id'
		    )
		    ->addColumn(
		        'entity_type',
		        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
		        32,
		        ['nullable' => false],
		        'Entity type code'
		    )
		    ->addColumn(
		        'entity_id',
		        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
		        null,
		        ['unsigned' => true, 'nullable' => false],
		        'Entity ID'
		    )
		    ->addColumn(
		        'request_path',
		        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
		        255,
		        [],
		        'Request Path'
		    )
		    ->addColumn(
		        'target_path',
		        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
		        255,
		        [],
		        'Target Path'
		    )
		    ->addColumn(
		        'redirect_type',
		        \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
		        null,
		        ['unsigned' => true, 'nullable' => false, 'default' => '0'],
		        'Redirect Type'
		    )
		    ->addColumn(
		        'store_id',
		        \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
		        null,
		        ['unsigned' => true, 'nullable' => false],
		        'Store Id'
		    )
		    ->addColumn(
		        'description',
		        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
		        255,
		        [],
		        'Description'
		    )
		    ->addColumn(
		        'is_autogenerated',
		        \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
		        null,
		        ['unsigned' => true, 'nullable' => false, 'default' => 0],
		        'Is rewrite generated automatically flag'
		    )
		    ->addColumn(
		        'metadata',
		        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
		        255,
		        [],
		        'Meta data for url rewrite'
		    )
		    ->addIndex(
		        $installer->getIdxName(
		            'url_rewrite',
		            ['request_path', 'store_id'],
		            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
		        ),
		        ['request_path', 'store_id'],
		        ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
		    )
		    ->addIndex(
		        $installer->getIdxName('url_rewrite', ['target_path']),
		        ['target_path']
		    )
		    ->addIndex(
		        $installer->getIdxName('url_rewrite', ['store_id', 'entity_id']),
		        ['store_id', 'entity_id']
		    )
		    ->setComment('Url Rewrites');
		$installer->getConnection()->createTable($table);
		
		$installer->endSetup();
		
	}
}