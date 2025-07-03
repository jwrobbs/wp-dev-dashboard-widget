<?php
/**
 * Dashboard Widget registration and framework for WP Dev Dashboard Widget
 *
 * @package WPDevDashboardWidget
 */

declare(strict_types=1);

namespace WPDevDashboardWidget;

class DashboardWidget
{
    /**
     * Registers the dashboard widget and sets up the section framework.
     */
    public static function registerDashboardWidget(): void
    {
        \add_action('wp_dashboard_setup', [__CLASS__, 'addDashboardWidget']);
    }

    /**
     * Adds the dashboard widget to the WordPress dashboard.
     */
    public static function addDashboardWidget(): void
    {
        \wp_add_dashboard_widget(
            'wp_dev_dashboard_widget',
            __('WP Dev Dashboard Widget', 'wp-dev-dashboard-widget'),
            [__CLASS__, 'renderDashboardWidget']
        );
    }

    /**
     * Render the dashboard widget, including sections, toggles, and content hooks.
     */
    public static function renderDashboardWidget(): void
    {
        // Fires before the dashboard widget sections are rendered.
        \do_action('wpddw_before_sections');

        // Render registered sections
        $sections = \apply_filters('wpddw_sections', []);
        foreach ($sections as $section) {
            self::renderSection($section);
        }

        // Fires after the dashboard widget sections are rendered.
        \do_action('wpddw_after_sections');
    }

    /**
     * Render a section.
     * @param array $section Section data: ['id' => string, 'title' => string, 'type' => string, 'data' => array, 'content' => string, 'collapsed' => bool]
     */
    public static function renderSection(array $section): void
    {
        $section_id = esc_attr($section['id'] ?? '');
        $title = esc_html($section['title'] ?? '');
        $type = $section['type'] ?? null;
        $data = $section['data'] ?? null;
        $content = $section['content'] ?? '';
        $collapsed = array_key_exists('collapsed', $section) ? !empty($section['collapsed']) : true;
        ?>
        <div class="wpddw-section" id="wpddw-section-<?php echo $section_id; ?>">
            <div class="wpddw-section-header">
                <button class="wpddw-toggle" aria-expanded="<?php echo $collapsed ? 'false' : 'true'; ?>" aria-controls="wpddw-content-<?php echo $section_id; ?>">
                    <?php echo $collapsed ? '+' : '-'; ?>
                </button>
                <span class="wpddw-section-title"><?php echo $title; ?></span>
            </div>
            <div class="wpddw-section-content" id="wpddw-content-<?php echo $section_id; ?>" style="display:<?php echo $collapsed ? 'none' : 'block'; ?>;">
                <?php
                switch ($type) {
                    case 'table':
                        self::renderTable($data);
                        break;
                    case 'list':
                        self::renderList($data);
                        break;
                    case 'button':
                        self::renderButton($data);
                        break;
                    default:
                        echo $content;
                        break;
                }
                ?>
            </div>
            <hr class="wpddw-section-border" />
        </div>
        <?php
    }

    /**
     * Render a table section.
     * @param array $data 2D array: first row is headers, rest are rows.
     */
    public static function renderTable($data): void
    {
        if (!is_array($data) || empty($data)) {
            return;
        }
        echo '<table class="wpddw-table">';
        $header = array_shift($data);
        echo '<thead><tr>';
        foreach ($header as $cell) {
            echo '<th>' . esc_html($cell) . '</th>';
        }
        echo '</tr></thead><tbody>';
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>';
                if ($cell instanceof Button) {
                    $cell->render();
                } else {
                    echo esc_html($cell);
                }
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }

    /**
     * Render a list section.
     * @param array $data List items.
     */
    public static function renderList($data): void
    {
        if (!is_array($data) || empty($data)) {
            return;
        }
        echo '<ul class="wpddw-list">';
        foreach ($data as $item) {
            echo '<li>';
            if ($item instanceof Button) {
                $item->render();
            } else {
                echo esc_html($item);
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    /**
     * Render a button section.
     * @param array $data Button data: ['label' => string, 'action' => string]
     */
    public static function renderButton($data): void
    {
        if (!is_array($data) || empty($data['label'])) {
            return;
        }
        $label = esc_html($data['label']);
        $action = esc_attr($data['action'] ?? '#');
        echo '<button class="wpddw-button" data-action="' . $action . '">' . $label . '</button>';
    }
}
