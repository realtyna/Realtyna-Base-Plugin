<?php

namespace Realtyna\Dev;

use RegexIterator;

class PluginSetup
{
    public static function changeNamespace(): void
    {
        $rootPath = dirname(__DIR__);
        $folderName = basename($rootPath);
        $newNamespace = 'Realtyna\\' . self::formatNamespace($folderName);

        $currentNamespace = 'Realtyna\\BasePlugin';

        // Change the namespace in PHP files
        $directory = new \RecursiveDirectoryIterator($rootPath);
        $iterator = new \RecursiveIteratorIterator($directory);
        $regex = new \RegexIterator($iterator, '/^.+\.php$/i', RegexIterator::GET_MATCH);

        foreach ($regex as $file) {
            $filePath = $file[0];
            $fileContent = file_get_contents($filePath);
            $fileContent = str_replace($currentNamespace, $newNamespace, $fileContent);
            file_put_contents($filePath, $fileContent);
        }

        // Change the namespace in composer.json
        $composerJsonPath = $rootPath . '/composer.json';
        if (file_exists($composerJsonPath)) {
            $composerJsonContent = file_get_contents($composerJsonPath);
            $composerJsonContent = str_replace(
                addslashes($currentNamespace) . "\\\\",
                addslashes($newNamespace) . "\\\\",
                $composerJsonContent
            );
            file_put_contents($composerJsonPath, $composerJsonContent);
        } else {
            echo "composer.json not found.\n";
        }

        echo "Namespace changed to {$newNamespace}\n";
    }

    public static function changePluginDetails(): void
    {
        $rootPath = dirname(__DIR__);
        $folderName = basename($rootPath);
        $slugName = strtolower($folderName);
        $constantName = strtoupper(str_replace('-', '_', $folderName));
        $pluginName = self::formatPluginName($folderName);

        // Rename the main plugin file
        $oldMainFile = $rootPath . '/realtyna-base-plugin.php';
        $newMainFile = $rootPath . '/' . $slugName . '.php';

        if (file_exists($oldMainFile)) {
            rename($oldMainFile, $newMainFile);
        } else {
            echo "Main plugin file not found.\n";
            return;
        }

        // Update the Plugin Name in the new main file
        $fileContent = file_get_contents($newMainFile);
        $fileContent = str_replace('Plugin Name: Realtyna Base Plugin', 'Plugin Name: ' . $pluginName, $fileContent);
        $fileContent = str_replace('Realtyna Base Plugin', $pluginName, $fileContent);
        $fileContent = str_replace('your-plugin-slug', $slugName, $fileContent);
        file_put_contents($newMainFile, $fileContent);

        // Replace REALTYNA_BASE_PLUGIN with the new constant
        $directory = new \RecursiveDirectoryIterator($rootPath);
        $iterator = new \RecursiveIteratorIterator($directory);
        $regex = new \RegexIterator($iterator, '/^.+\.php$/i', RegexIterator::GET_MATCH);

        foreach ($regex as $file) {
            $filePath = $file[0];
            $fileContent = file_get_contents($filePath);
            $fileContent = str_replace('REALTYNA_BASE_PLUGIN', $constantName, $fileContent);
            file_put_contents($filePath, $fileContent);
        }

        // Update the config file
        $configFilePath = $rootPath . '/src/Config/config.php';
        if (file_exists($configFilePath)) {
            $configContent = file_get_contents($configFilePath);
            $configContent = str_replace("'name' => 'Realtyna Base Plugin'", "'name' => '{$pluginName}'", $configContent);
            $configContent = str_replace("'slug' => 'realtyna-base-plugin'", "'slug' => '{$slugName}'", $configContent);
            $configContent = str_replace("'text-domain' => 'realtyna-base-plugin'", "'text-domain' => '{$slugName}'", $configContent);
            $configContent = str_replace('TEST_PLUGIN_DIR', strtoupper($slugName) . '_DIR', $configContent);
            file_put_contents($configFilePath, $configContent);
        } else {
            echo "config.php not found.\n";
        }

        echo "Plugin details updated with name {$pluginName}\n";
    }

    private static function formatNamespace(string $name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    private static function formatPluginName(string $name): string
    {
        return ucwords(str_replace('-', ' ', $name));
    }
}
