<?php

namespace Realtyna\BasePlugin\Components\Test\Shortcodes;

use Realtyna\Core\Abstracts\ShortcodeAbstract;

class TestShortcode extends ShortcodeAbstract
{
    /**
     * Get the tag name for the shortcode.
     *
     * @return string
     */
    protected function getTag(): string
    {
        return 'test_shortcode';
    }

    /**
     * Handle the rendering of the shortcode.
     *
     * @param array $atts Shortcode attributes.
     * @param string|null $content The enclosed content (if any).
     * @return string The output of the shortcode.
     */
    public function render(array $atts, ?string $content = null): string
    {
        // Process attributes with defaults
        $atts = shortcode_atts([
            'title' => 'Default Title',
        ], $atts, $this->getTag());

        // Generate the output using the helper method
        return $this->output($atts, $content);
    }

    /**
     * Generate and return the output for the shortcode.
     *
     * @param array $atts Processed attributes.
     * @param string|null $content The enclosed content (if any).
     * @return string The final output to be displayed.
     */
    protected function output(array $atts, ?string $content = null): string
    {
        // Example output (customized)
        $output = '<div class="test-shortcode">';
        $output .= '<h2>' . esc_html($atts['title']) . '</h2>';
        if ($content) {
            $output .= '<p>' . esc_html($content) . '</p>';
        }
        $output .= '</div>';

        return $output;
    }
}
