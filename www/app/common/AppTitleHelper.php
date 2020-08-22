<?php


    namespace app\common;


    class AppTitleHelper {

        public static function getTitle(string $os): string {
            return Consts::osTitles()[$os] ?: $os;
        }

        public static function getShortTitle(string $os): string {
            return Consts::osTitlesShort()[$os] ?: $os;
        }

        /**
         * @param string $clientOs
         * @param string[] $appOs
         * @return string
         */
        public static function formatOsList(string $clientOs, array $appOs): string {
            Utils::sortByOrder($appOs, [$clientOs]);
            $osTitles = array_map(function ($os) {
                return self::getShortTitle($os);
            }, $appOs);
            return join("/", $osTitles);
        }

    }