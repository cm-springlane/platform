<?php declare(strict_types=1);

namespace Shopware\Core\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1536233030OrderDelivery extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1536233030;
    }

    public function update(Connection $connection): void
    {
        $connection->executeQuery('
            CREATE TABLE `order_delivery` (
              `id` BINARY(16) NOT NULL,
              `version_id` BINARY(16) NOT NULL,
              `order_id` BINARY(16) NOT NULL,
              `order_version_id` BINARY(16) NOT NULL,
              `state_id` BINARY(16) NOT NULL,
              `shipping_order_address_id` BINARY(16) NULL,
              `shipping_order_address_version_id` BINARY(16) NULL,
              `shipping_method_id` BINARY(16) NOT NULL,
              `tracking_code` VARCHAR(200) COLLATE utf8mb4_unicode_ci NULL,
              `shipping_date_earliest` DATE NOT NULL,
              `shipping_date_latest` DATE NOT NULL,
              `shipping_costs` JSON NOT NULL,
              `attributes` JSON NULL,
              `created_at` DATETIME(3) NOT NULL,
              `updated_at` DATETIME(3) NULL,
              PRIMARY KEY (`id`, `version_id`),
              INDEX `idx.state_index` (`state_id`),
              CONSTRAINT `json.shipping_costs` CHECK (JSON_VALID(`shipping_costs`)),
              CONSTRAINT `json.attributes` CHECK (JSON_VALID(`attributes`)),
              CONSTRAINT `fk.order_delivery.order_id` FOREIGN KEY (`order_id`, `order_version_id`)
                REFERENCES `order` (`id`, `version_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.order_delivery.shipping_order_address_id` FOREIGN KEY (`shipping_order_address_id`, `shipping_order_address_version_id`)
                REFERENCES `order_address` (`id`, `version_id`) ON DELETE SET NULL ON UPDATE CASCADE,
              CONSTRAINT `fk.order_delivery.shipping_method_id` FOREIGN KEY (`shipping_method_id`)
                REFERENCES `shipping_method` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
