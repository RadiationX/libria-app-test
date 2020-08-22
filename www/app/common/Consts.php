<?php

    namespace app\common;

    use app\models\AppTarget;

    /*
     * из browscap
     * $platforms = ['unknown', 'Linux', 'Android', 'Win10', 'Win8.1', 'Win8', 'Win7', 'MacOSX', 'WinVista', 'iOS', 'Xbox OS 10', 'WinPhone10', 'Xbox OS 10 (Mobile View)', 'Win32', 'WinPhone8.1', 'ipadOS', 'Win64', 'Xbox OS', 'Xbox 360'];
     * $deviceTypes = ['unknown', 'Desktop', 'TV Device', 'Mobile Phone', 'Tablet', 'Mobile Device'];
     * */

    class Consts {
        const APP_ANDROID = 'android_mobile';
        const APP_ANDROID_TV = 'android_tv';
        const APP_IOS = 'ios';
        const APP_MACOS_CATALYST = 'macos_catalyst';
        const APP_WINTEN = 'winten';
        const APP_ANILIBRIX = 'cross_anilibrix';
        const APP_QT = 'cross_qt';

        const OS_ANDROID = 'android';
        const OS_IOS = 'ios';
        const OS_MACOS = 'macos';
        const OS_LINUX = 'linux';
        const OS_WINDOWS = 'windows';
        const OS_UNKNOWN = 'unknown';

        const TYPE_MOBILE = 'mobile';
        const TYPE_TV = 'tv';
        const TYPE_TABLET = 'tablet';
        const TYPE_DESKTOP = 'desktop';
        const TYPE_UNKNOWN = 'unknown';

        const APP_KEYS = [
            Consts::APP_ANDROID,
            Consts::APP_ANDROID_TV,
            Consts::APP_IOS,
            Consts::APP_MACOS_CATALYST,
            Consts::APP_WINTEN,
            Consts::APP_ANILIBRIX,
            Consts::APP_QT
        ];

        const OS_KEYS = [
            Consts::OS_ANDROID,
            Consts::OS_IOS,
            Consts::OS_MACOS,
            Consts::OS_LINUX,
            Consts::OS_WINDOWS
        ];

        const TYPE_KEYS = [
            Consts::TYPE_MOBILE,
            Consts::TYPE_TV,
            Consts::TYPE_TABLET,
            Consts::TYPE_DESKTOP
        ];

        private static array $osTitles = [
            Consts::OS_ANDROID => "Android",
            Consts::OS_IOS => "iOS",
            Consts::OS_MACOS => "macOS",
            Consts::OS_LINUX => "Linux",
            Consts::OS_WINDOWS => "Windows"
        ];

        /**
         * @var string[]
         */
        private static array $osTitlesShort = [
            Consts::OS_ANDROID => "Android",
            Consts::OS_IOS => "iOS",
            Consts::OS_MACOS => "Mac",
            Consts::OS_LINUX => "Linux",
            Consts::OS_WINDOWS => "Win"
        ];

        private static ?array $appTargets = null;

        private static array $appsOrder = [
            Consts::OS_MACOS => [
                Consts::TYPE_DESKTOP => [
                    Consts::APP_ANILIBRIX,
                    Consts::APP_QT,
                    Consts::APP_MACOS_CATALYST
                ]
            ],
            Consts::OS_LINUX => [
                Consts::TYPE_DESKTOP => [
                    Consts::APP_ANILIBRIX,
                    Consts::APP_QT
                ]
            ],
            Consts::OS_WINDOWS => [
                Consts::TYPE_DESKTOP => [
                    Consts::APP_WINTEN,
                    Consts::APP_ANILIBRIX,
                    Consts::APP_QT
                ]
            ]
        ];

        /**
         * @return AppTarget[]
         */
        private static function createAppTargets(): array {
            return [
                Consts::APP_ANDROID => new AppTarget(
                    [Consts::OS_ANDROID],
                    [Consts::TYPE_MOBILE]
                ),
                Consts::APP_ANDROID_TV => new AppTarget(
                    [Consts::OS_ANDROID],
                    [Consts::TYPE_TV]
                ),
                Consts::APP_IOS => new AppTarget(
                    [Consts::OS_IOS],
                    [Consts::TYPE_MOBILE, Consts::TYPE_TABLET]
                ),
                Consts::APP_MACOS_CATALYST => new AppTarget(
                    [Consts::OS_MACOS],
                    [Consts::TYPE_DESKTOP]
                ),
                Consts::APP_WINTEN => new AppTarget(
                    [Consts::OS_WINDOWS],
                    [Consts::TYPE_DESKTOP]
                ),
                Consts::APP_ANILIBRIX => new AppTarget(
                    [Consts::OS_MACOS, Consts::OS_LINUX, Consts::OS_WINDOWS],
                    [Consts::TYPE_DESKTOP]
                ),
                Consts::APP_QT => new AppTarget(
                    [Consts::OS_MACOS, Consts::OS_LINUX, Consts::OS_WINDOWS],
                    [Consts::TYPE_DESKTOP]
                )
            ];
        }

        /**
         * @return string[][][]
         */
        public static function appsOrder(): array {
            return self::$appsOrder;
        }

        /**
         * @return AppTarget[]
         */
        public static function appTargets(): array {
            return Utils::lazyInit(self::$appTargets, function () {
                return self::createAppTargets();
            });
        }

        /**
         * @return array|string[]
         */
        public static function osTitles() {
            return self::$osTitles;
        }

        /**
         * @return string[]
         */
        public static function osTitlesShort(): array {
            return self::$osTitlesShort;
        }
    }


