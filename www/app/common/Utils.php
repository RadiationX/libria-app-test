<?php
    declare(strict_types=1);

    namespace app\common;

    class Utils {

        /**
         * @param $variable
         * @param callable $fn
         * @return mixed
         */
        public static function lazyInit(&$variable, $fn) {
            if ($variable === null && is_callable($fn)) {
                $variable = call_user_func($fn);
            }
            return $variable;
        }

        public static function fileTime(string $relativePath): string {
            $file = $_SERVER['DOCUMENT_ROOT'] . $relativePath;
            if (!file_exists($file)) {
                return $relativePath;
            }
            $fileTime = filemtime($file);
            return "{$relativePath}?{$fileTime}";
        }

        public static function includeCss(string $relativePath) {
            $file = Utils::fileTime($relativePath);
            echo '<link rel="stylesheet" type="text/css" href="' . $file . '">';
        }

        public static function sortByOrder(array &$array, array $order): array {
            usort($array, function ($a, $b) use ($order) {
                foreach ($order as $value) {
                    if ($a === $value) {
                        return 0;
                    }
                    if ($b === $value) {
                        return 1;
                    }
                }
                return 0;
            });
            return $array;
        }
    }

