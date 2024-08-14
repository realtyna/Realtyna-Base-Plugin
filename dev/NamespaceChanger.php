<?php

namespace Realtyna\Dev;

use RegexIterator;

class NamespaceChanger
{
    public static function changeNamespace(): void
    {
        $currentNamespace = 'Realtyna\\BasePlugin';
        echo "Enter your desired namespace (e.g., MyCompany\\MyPlugin): ";
        $handle = fopen("php://stdin", "r");
        $newNamespace = trim(fgets($handle));

        if (empty($newNamespace)) {
            echo "No namespace provided. Using default: {$currentNamespace}\n";
            return;
        }

        $rootPath = __DIR__ . '/../..';

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
}
