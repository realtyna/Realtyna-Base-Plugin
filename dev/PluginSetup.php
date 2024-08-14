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
        $slugName = strtolower(str_replace(' ', '-', $folderName));
        $constantName = strtoupper(str_replace(' ', '_', $folderName));
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
