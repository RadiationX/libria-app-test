<?php


    namespace app\common;


    class AppUrlHelper {

        // !!! Не меняй значения, а то сломаются ссылки
        private const APP_ANDROID = 'android';
        private const APP_ANDROID_TV = 'androidtv';
        private const APP_IOS = 'ios';
        private const APP_MACOS_CATALYST = 'catalyst';
        private const APP_WINTEN = 'win';
        private const APP_ANILIBRIX = 'anilibrix';
        private const APP_QT = 'qt';

        private const URL_IDS = [
            self::APP_ANDROID,
            self::APP_ANDROID_TV,
            self::APP_IOS,
            self::APP_MACOS_CATALYST,
            self::APP_WINTEN,
            self::APP_ANILIBRIX,
            self::APP_QT
        ];

        private const APP_TO_URL = [
            Consts::APP_ANDROID => self::APP_ANDROID,
            Consts::APP_ANDROID_TV => self::APP_ANDROID_TV,
            Consts::APP_IOS => self::APP_IOS,
            Consts::APP_MACOS_CATALYST => self::APP_MACOS_CATALYST,
            Consts::APP_WINTEN => self::APP_WINTEN,
            Consts::APP_ANILIBRIX => self::APP_ANILIBRIX,
            Consts::APP_QT => self::APP_QT
        ];

        private const URL_TO_APP = [
            self::APP_ANDROID => Consts::APP_ANDROID,
            self::APP_ANDROID_TV => Consts::APP_ANDROID_TV,
            self::APP_IOS => Consts::APP_IOS,
            self::APP_MACOS_CATALYST => Consts::APP_MACOS_CATALYST,
            self::APP_WINTEN => Consts::APP_WINTEN,
            self::APP_ANILIBRIX => Consts::APP_ANILIBRIX,
            self::APP_QT => Consts::APP_QT
        ];

        public static function getAppUrl(string $appKey): string {
            return "/app/" . self::APP_TO_URL[$appKey] . "/";
        }

        public static function getAppKey(string $urlId): string {
            return self::URL_TO_APP[$urlId];
        }
    }