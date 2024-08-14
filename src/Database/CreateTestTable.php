<?php
namespace Realtyna\BasePlugin\Database;


use Realtyna\Core\Abstracts\Database\MigrationAbstract;

class CreateTestTable extends MigrationAbstract
{
    public function up(): void
    {
        global $wpdb;
        $this->runQuery("
            CREATE TABLE IF NOT EXISTS {$wpdb->prefix}my_table (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                description TEXT
            )
        ");
    }

    public function down(): void
    {
        global $wpdb;
        $this->runQuery("DROP TABLE IF EXISTS {$wpdb->prefix}my_table");
    }
}
