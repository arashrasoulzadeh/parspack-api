<?php

namespace App\Http\Controllers;

class ProcessController extends Controller
{

    /**
     * list running process
     * @return string|null
     */
    public function index()
    {
        $list = shell_exec('ps aux | awk \'
BEGIN { ORS = ""; print " [ "}
{ printf "%s{\"user\": \"%s\", \"pid\": \"%s\", \"cpu\": \"%s\", \"mem\": \"%s\",\"vsz\": \"%s\", \"rss\": \"%s\", \"tt\": \"%s\", \"start\": \"%s\",\"started\": \"%s\", \"time\": \"%s\", \"command\": \"%s\"}",
      separator, $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11
  separator = ", "
}
END { print " ] " }\';');


        return $list;
    }
}
