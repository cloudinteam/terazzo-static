<?php

declare(strict_types=1);

namespace Staatic\Vendor;

use wpdb;
use Staatic\WordPress\Migrations\AbstractMigration;

return new class extends AbstractMigration {
    /**
     * @param wpdb $wpdb
     * @return void
     */
    public function up($wpdb)
    {
        $this->query(
            $wpdb,
            "ALTER TABLE {$wpdb->prefix}staatic_publications ADD is_preview TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER deployment_uuid"
        );
    }

    /**
     * @param wpdb $wpdb
     * @return void
     */
    public function down($wpdb)
    {
        $this->query($wpdb, "ALTER TABLE {$wpdb->prefix}staatic_publications DROP is_preview");
    }
};
