<?php

use yii\db\Migration;

/**
 * Class m240909_185930_init_tables
 */
class m240909_185930_init_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = '
            DROP TABLE IF EXISTS `assets`;
            /*!40101 SET @saved_cs_client     = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `assets` (
              `id` int unsigned NOT NULL AUTO_INCREMENT,
              `type` enum(\'enumerable\',\'physical\') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            DROP TABLE IF EXISTS `currency`;
            /*!40101 SET @saved_cs_client     = @@character_set_client */;
            /*!50503 SET character_set_client = utf8mb4 */;
            CREATE TABLE `currency` (
              `id` smallint unsigned NOT NULL AUTO_INCREMENT,
              `title` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            INSERT INTO `currency` VALUES (1,\'руб.\'),(2,\'$\');

            CREATE TABLE `enumerable` (
              `id` int unsigned NOT NULL,
              `amount` decimal(10,2) NOT NULL,
              `place` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
              `account` int unsigned NOT NULL,
              `item` varchar(32) DEFAULT NULL,
              `currency_id` tinyint unsigned NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            DROP TABLE IF EXISTS `physical`;

            CREATE TABLE `physical` (
              `id` int unsigned NOT NULL,
              `starting_price` decimal(10,2) unsigned NOT NULL,
              `residual_value` decimal(10,2) unsigned NOT NULL,
              `estimated_value` decimal(10,2) unsigned NOT NULL,
              `currency_id` smallint unsigned NOT NULL,
              `inventory_number` int unsigned NOT NULL,
              `production_date` int NOT NULL,
              `item` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ';

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = '
            DROP TABLE IF EXISTS `assets`;
            DROP TABLE IF EXISTS `currency`;
            DROP TABLE IF EXISTS `enumerable`;
            DROP TABLE IF EXISTS `physical`;
        ';

        $this->execute($sql);
    }
}
