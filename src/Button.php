<?php

namespace WPDevDashboardWidget;

/**
 * Class Button
 * Represents a button for use in dashboard widget tables/lists.
 */
class Button
{
    public string $label;
    public string $action;
    public array $attributes;

    /**
     * Button constructor.
     *
     * @param array $params ['label' => string, 'action' => string, 'attributes' => array]
     */
    public function __construct(array $params)
    {
        $this->label = $params['label'] ?? '';
        $this->action = $params['action'] ?? '#';
        $this->attributes = $params['attributes'] ?? [];
    }

    /**
     * Render the button as HTML.
     */
    public function render(): void
    {
        $attr = '';
        foreach ($this->attributes as $key => $value) {
            $attr .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }
        echo '<button class="wpddw-button" data-action="' . esc_attr($this->action) . '"' . $attr . '>' . esc_html($this->label) . '</button>';
    }
}
