<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDirectoryRequest;
use App\Http\Requests\CreateFileRequest;

class FileController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * create file
     * @param CreateFileRequest $request
     */
    public function create(CreateFileRequest $request)
    {
        $path = env("user_directory", "/tmp") . "/" . $request->name;
        $file = fopen($path, "w");
        $txt = "ParsPack Sample";
        fwrite($file, $txt);
        fclose($file);
    }

    /**
     * create file
     * @param CreateDirectoryRequest $request
     */
    public function createDirectory(CreateDirectoryRequest $request)
    {
        $path = env("user_directory", "/tmp") . "/" . $request->name;
        mkdir($path);
    }

    public function files()
    {
        $dir = env("user_directory", "/tmp");

        $scannedFiles = scandir($dir . "/");
        $files = [];

        foreach ($scannedFiles as $file) {
            if (!in_array(trim($file), ['.', '..'])) {
                $files[] = $file;
            }
        }

        $files = array_values($files);
        return $files;

    }

    /**
     * list files and dirs
     */
    public function directories()
    {
        $dir = env("user_directory", "/tmp");
        $directories = [];
        foreach (glob($dir . "/*", GLOB_ONLYDIR) as $dir) {
            $dirname = basename($dir);
            $directories[] = $dirname;
        }
        $dir = env("user_directory", "/tmp");

        return $directories;

    }
}
