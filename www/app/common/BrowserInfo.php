<?php
    declare(strict_types=1);

    namespace app\common;

    class BrowserInfo {

        private static ?array $browserInfo = null;
        private static ?string $os = null;
        private static ?string $type = null;

        public static function getOs(): string {
            return Utils::lazyInit(self::$os, function () {
                return self::fetchOsInfo();
            });
        }

        public static function getType(): string {
            return Utils::lazyInit(self::$type, function () {
                return self::fetchTypeInfo();
            });
        }

        private static function fetchOsInfo(): string {
            $os = self::fetchBrowserInfo()['platform'];

            if (empty($os)) {
                return Consts::OS_UNKNOWN;
            }
            if (stripos($os, 'macos') !== false) {
                return Consts::OS_MACOS;
            }
            if (stripos($os, 'linux') !== false) {
                return Consts::OS_LINUX;
            }
            if (stripos($os, 'win') !== false) {
                return Consts::OS_WINDOWS;
            }
            if (stripos($os, 'android') !== false) {
                return Consts::OS_ANDROID;
            }
            if (stripos($os, 'ios') !== false) {
                return Consts::OS_IOS;
            }

            return Consts::OS_UNKNOWN;
        }

        private static function fetchTypeInfo(): string {
            $type = self::fetchBrowserInfo()['device_type'];

            if (empty($type)) {
                return Consts::TYPE_UNKNOWN;
            }
            if (stripos($type, 'desktop') !== false) {
                return Consts::TYPE_DESKTOP;
            }
            if (stripos($type, 'tv') !== false) {
                return Consts::TYPE_TV;
            }
            if (stripos($type, 'mobile') !== false) {
                return Consts::TYPE_MOBILE;
            }
            if (stripos($type, 'tablet') !== false) {
                return Consts::TYPE_TABLET;
            }

            return Consts::TYPE_UNKNOWN;
        }

        private static function fetchBrowserInfo(): array {
            return Utils::lazyInit(self::$browserInfo, function () {
                $browser = get_browser(null, true);
                if ($browser === false) {
                    return [];
                }
                return (array)$browser;
            });
        }
    }