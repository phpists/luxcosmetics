<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SiteConfigService
{
    const FILE_NAME = 'site.json';

    const TEXT = 'string';

    const BOOL = 'boolean';

    const NUMERIC = 'numeric';

    static private function read_config() {

        if (Storage::disk('config')->exists(self::FILE_NAME)) {
            $content = Storage::disk('config')->json(self::FILE_NAME);
            return $content;
        }
        else {
            Storage::disk('config')->put(self::FILE_NAME, '');
        }
        return null;
    }

    static private function write_config($content) {
        $content = json_encode($content);

        Storage::disk('config')->put(self::FILE_NAME, $content);

        return null;
    }

    static public function getParam($name) {
        return self::read_config() !== null? self::read_config()[$name]: null;
    }

    static public function getParamValue($name) {
        return self::read_config() !== null? self::read_config()[$name]['value']: null;
    }

    static public function getParams(): array
    {
        return self::read_config()??[];
    }

    static public function setParam($name, $value, $type) {
        $data = self::read_config()??[];
        $data[$name] = ['value' => $value, 'type' => $type];
        self::write_config($data);
    }

}
