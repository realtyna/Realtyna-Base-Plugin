<?php
namespace Realtyna\BasePlugin\Settings;

/**
 * Class Settings
 *
 * @package Realtyna\BasePlugin\Settings
 */
class Settings
{
    /**
     * @var array List of allowed option keys
     */
    private static array $allowed_options = [
        // Add other allowed options here
    ];

    /**
     * Return Settings
     *
     * @return array
     */
    public static function get_settings(): array
    {
        return get_option(REALTYNA_BASE_PLUGIN_SLUG . '_settings', []);
    }

    /**
     * Update Settings
     *
     * @param array $settings
     *
     * @return void
     */
    public static function update_settings(array $settings): void
    {
        // Filter the settings to include only allowed options
        $filtered_settings = array_intersect_key($settings, array_flip(self::$allowed_options));
        update_option(REALTYNA_BASE_PLUGIN_SLUG . '_settings', $filtered_settings);
    }

    /**
     * Return the setting
     *
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public static function get_setting(string $key, mixed $default = null): mixed
    {
        if (!in_array($key, self::$allowed_options)) {
            return $default; // Return default if the key is not allowed
        }

        $settings = self::get_settings();

        return $settings[$key] ?? $default;
    }

    /**
     * Update the setting
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public static function update_setting(string $key, mixed $value): void
    {
        if (!in_array($key, self::$allowed_options)) {
            return; // Do nothing if the key is not allowed
        }

        $settings = self::get_settings();
        $settings[$key] = $value;

        self::update_settings($settings);
    }

    /**
     * Delete the settings
     *
     * @return void
     */
    public static function delete_settings(): void
    {
        delete_option(REALTYNA_BASE_PLUGIN_SLUG . '_settings');
    }

    /**
     * Get the list of allowed options
     *
     * @return array
     */
    public static function get_allowed_options(): array
    {
        return self::$allowed_options;
    }
}
