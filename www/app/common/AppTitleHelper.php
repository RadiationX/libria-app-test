<?php


    namespace app\common;


    use app\models\AppTarget;

    class AppTitleHelper {

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

        /**
         * @var string[]
         */
        private static array $typeTitles = [
            Consts::TYPE_MOBILE => "",
            Consts::TYPE_TV => "TV",
            Consts::TYPE_TABLET => "",
            Consts::TYPE_DESKTOP => ""
        ];

        public static function getTitle(string $os): string {
            return self::$osTitles[$os] ?: "";
        }

        public static function getShortTitle(string $os): string {
            return self::$osTitlesShort[$os] ?: "";
        }

        public static function getTypeTitle(string $type): string {
            return self::$typeTitles[$type] ?: "";
        }

        public static function createTitle(AppTarget $target): string {
            $clientOs = BrowserInfo::getOs();
            $clientType = BrowserInfo::getType();
            $appOs = $target->getOsList();
            $appType = $target->getTypeList();
            $isSingleOs = count($target->getOsList()) == 1;
            $osTitlesSource = $isSingleOs ? self::$osTitles : self::$osTitlesShort;
            $osTitles = self::formatList($clientOs, $appOs, $osTitlesSource);
            $typeTitles = self::formatList($clientType, $appType, self::$typeTitles);
            return trim("{$osTitles} {$typeTitles}");
        }

        public static function formatList(string $key, array $values, array $titles): string {
            Utils::sortByOrder($values, [$key]);
            $result = array_map(function ($value) use ($titles) {
                return $titles[$value];
            }, $values);
            $result = array_filter($result, function ($value) {
                return !empty($value);
            });
            $result = array_values($result);
            return join("/", $result);
        }
    }