<?php

namespace Realtyna\BasePlugin\Components\Test\Widgets;

use Realtyna\Core\Abstracts\WidgetAbstract;

class TestWidget extends WidgetAbstract
{
    /**
     * Get the widget's ID.
     *
     * @return string
     */
    protected function getWidgetId(): string
    {
        return 'test_widget';
    }

    /**
     * Get the widget's name.
     *
     * @return string
     */
    protected function getWidgetName(): string
    {
        return __('Test Widget', 'text-domain');
    }

    /**
     * Get the widget's options, including description and any other settings.
     *
     * @return array
     */
    protected function getWidgetOptions(): array
    {
        return [
            'classname'   => 'test_widget',
            'description' => __('A widget for testing purposes', 'text-domain'),
        ];
    }

    /**
     * Output the widget's form in the admin area.
     *
     * @param array $instance The current widget instance's settings.
     * @return void
     */
    public function form($instance): void
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text-domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    /**
     * Save the widget's settings.
     *
     * @param array $new_instance The new settings for the widget instance.
     * @param array $old_instance The previous settings for the widget instance.
     * @return array The updated settings to save.
     */
    public function update($new_instance, $old_instance): array
    {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';

        return $instance;
    }

    /**
     * Output the content of the widget.
     *
     * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
     * @param array $instance The settings for the particular widget instance.
     * @return void
     */
    public function widget($args, $instance): void
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Output the content of the widget
        echo '<p>' . __('Hello, World!', 'text-domain') . '</p>';

        echo $args['after_widget'];
    }
}

