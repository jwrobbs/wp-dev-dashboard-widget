<?php
/**
 * Site Info Module - Hooks
 *
 * Registers the section with the dashboard widget framework.
 */

declare(strict_types=1);

namespace WPDevDashboardWidget\Modules\SiteInfo;

use WPDevDashboardWidget\Modules\SiteInfo\SiteInfo;

add_filter('wpddw_sections', function(array $sections) {
    $sections[] = [
        'id' => 'site-info',
        'title' => 'Site Info',
        'type' => 'table',
        'data' => SiteInfo::getSiteInfoTable(),
        'collapsed' => false,
    ];
    return $sections;
});
