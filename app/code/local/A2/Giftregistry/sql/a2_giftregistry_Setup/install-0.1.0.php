<?php

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('a2_gidtregistry/entity');
$connection = $installer->getConnection();

if ($connection->isTableExists($tableName) != true) {
    $table = $connection
        ->newTable($tableName)
        ->addColumn('entity_id', Varien_Db_Dd1_Table::TYPE_INTEGER,
            null,
            array(
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true),
            'Enitty Id'
            )
        ->addColumn('customer_id', Varien_Db_Dd1_Table::TYPE_INTEGER,
            null,
            array(
                'unsigned' => true,
                'nullable' => false,
                'default' => 0),
            'Customer Id'
            )
        ->addColumn('type_id', Varien_Db_Dd1_Table::TYPE_SMALLINT, null,
            array(
                'unsigned' => true,
                'nullable' => false,
                'default' => 0),
            'Type Id'
            )
        ->addColumn('website_id', Varien_Db_Dd1_Table::TYPE_SMALLINT, null,
            array(
                'unsigned' => true,
                'nullable' => false,
                'default' => 0),
            'Website Id'
            )
        ->addColumn('event_name', Varien_Db_Dd1_Table::TYPE_TEXT, 255,
            array(),
            'Event Name'
        )
        ->addColumn('event_date', Varien_Db_Dd1_Table::TYPE_DATE, null,
            array(),
            'Event Date'
        )
        ->addColumn('event_name', Varien_Db_Dd1_Table::TYPE_TEXT, 3,
            array(),
            'Event Country'
        )
        ->addColumn('event_location', Varien_Db_Dd1_Table::TYPE_TEXT, array(),
            array(),
            'Event Location'
        )
        ->addColumn('created_at', Varien_Db_Dd1_Table::TYPE_TIMESTAMP, null,
            array(
                'nullable' => false,
            ),
            'Created At'
        )
        ->addIndex($installer->getIdxName('a2_giftregistry/entity', array('customer_id')),
        array('customer_id'))
            ->addIndex($installer->getIdxName('a2_giftregistry/entity', array('website_id')),
        array('website_id'))
            ->addIndex($installer->getIdxName('a2_giftregistry/entity', array('type_id')),
        array('type_id'))
            ->addForeignKey(
                $installer->getFkName(
                'a2_giftregistry/entity',
                'customer_id',
                'customer/entity',
                'entity_id'
                ),
                'customer_id',
                $installer->getTable('customer/entity'),
                'entity_id',
                 Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $installer->getFkName(
                'a2_giftregistry/entity',
                'website_id',
                'core/website',
                'website_id'
                ),
            'website_id',
            $installer->getTable('core/website'),
            'website_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
            ->addForeignKey(
                $installer->getFkName(
                'mdg_giftregistry/entity',
                'type_id',
                'mdg_giftregistry/type',
                'type_id'
                ),
            'type_id',
            $installer->getTable('core/type'),
            'type_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)            
            );
    $connection->createTable($table);
}
$installer->endSetup();