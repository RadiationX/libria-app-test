<?php

    namespace app\common;

    use app\models\AppRequirements;

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

        private static ?array $APP_REQS = null;

        private static array $APPS_ORDER = [
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
         * @return AppRequirements[]
         */
        private static function createAppReqs() {
            return [
                Consts::APP_ANDROID => new AppRequirements(
                    [Consts::OS_ANDROID],
                    [Consts::TYPE_MOBILE]
                ),
                Consts::APP_ANDROID_TV => new AppRequirements(
                    [Consts::OS_ANDROID],
                    [Consts::TYPE_TV]
                ),
                Consts::APP_IOS => new AppRequirements(
                    [Consts::OS_IOS],
                    [Consts::TYPE_MOBILE, Consts::TYPE_TABLET]
                ),
                Consts::APP_MACOS_CATALYST => new AppRequirements(
                    [Consts::OS_MACOS],
                    [Consts::TYPE_DESKTOP]
                ),
                Consts::APP_WINTEN => new AppRequirements(
                    [Consts::OS_WINDOWS],
                    [Consts::TYPE_DESKTOP]
                ),
                Consts::APP_ANILIBRIX => new AppRequirements(
                    [Consts::OS_MACOS, Consts::OS_LINUX, Consts::OS_WINDOWS],
                    [Consts::TYPE_DESKTOP]
                ),
                Consts::APP_QT => new AppRequirements(
                    [Consts::OS_MACOS, Consts::OS_LINUX, Consts::OS_WINDOWS],
                    [Consts::TYPE_DESKTOP]
                )
            ];
        }

        /**
         * @return string[][][]
         */
        public static function appsOrder() {
            return self::$APPS_ORDER;
        }

        /**
         * @return AppRequirements[]
         */
        public static function appReqs() {
            return Utils::lazyInit(self::$APP_REQS, function () {
                return self::createAppReqs();
            });
        }
    }


