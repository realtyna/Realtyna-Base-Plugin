<?php

namespace Realtyna\BasePlugin\dev;

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

        $directory = new \RecursiveDirectoryIterator(__DIR__);
        $iterator = new \RecursiveIteratorIterator($directory);
        $regex = new \RegexIterator($iterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);

        foreach ($regex as $file) {
            $filePath = $file[0];
            $fileContent = file_get_contents($filePath);
            $fileContent = str_replace($currentNamespace, $newNamespace, $fileContent);
            file_put_contents($filePath, $fileContent);
        }

        echo "Namespace changed to {$newNamespace}\n";
    }
}
