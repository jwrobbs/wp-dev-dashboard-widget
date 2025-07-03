<?php
/**
 * Site Info Model
 *
 * Assembles basic site info for display in the dashboard widget as a table.
 */

declare(strict_types=1);

namespace WPDevDashboardWidget\Modules\SiteInfo;

class SiteInfo
{
    /**
     * Assembles the site info data as a table (header + rows).
     *
     * @return array
     */
    public static function getSiteInfoTable(): array
    {
        global $wpdb;
        $theme_count = count(wp_get_themes());
        $plugin_count = count(get_plugins());
        $db_type = method_exists($wpdb, 'db_server_info') ? $wpdb->db_server_info() : $wpdb->db_version();
        return [
            ['Info', 'Value'],
            ['WordPress Version', get_bloginfo('version')],
            ['PHP Version', phpversion()],
            ['DB Type/Version', $db_type],
            ['Theme Count', $theme_count],
            ['Plugin Count', $plugin_count],
        ];
    }
}
