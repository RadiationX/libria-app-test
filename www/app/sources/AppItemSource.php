<?php
    declare(strict_types=1);

    namespace app\sources;

    use app\common\Consts;
    use app\common\Utils;
    use app\models\AppItem;

    class AppItemSource {

        private ?array $list = null;

        /**
         * @return array
         */
        public function getList(): array {
            return Utils::lazyInit($this->list, function () {
                return $this->fetchList();
            });
        }

        /**
         * @return AppItem[]
         */
        private function fetchList() {
            return [
                Consts::APP_ANDROID => new AppItem(
                    Consts::APP_ANDROID,
                    Consts::appTargets()[Consts::APP_ANDROID],
                    'app_android_mobile.png',
                    "AniLibria"
                ),
                Consts::APP_ANDROID_TV => new AppItem(
                    Consts::APP_ANDROID_TV,
                    Consts::appTargets()[Consts::APP_ANDROID_TV],
                    'app_android_tv.png',
                    "AniLibria TV"
                ),
                Consts::APP_IOS => new AppItem(
                    Consts::APP_IOS,
                    Consts::appTargets()[Consts::APP_IOS],
                    'app_ios.png',
                    "AniLibria"
                ),
                Consts::APP_MACOS_CATALYST => new AppItem(
                    Consts::APP_MACOS_CATALYST,
                    Consts::appTargets()[Consts::APP_MACOS_CATALYST],
                    'app_macos_catalyst.png',
                    "AniLibria"
                ),
                Consts::APP_WINTEN => new AppItem(
                    Consts::APP_WINTEN,
                    Consts::appTargets()[Consts::APP_WINTEN],
                    'app_winten.png',
                    "AniLibria"
                ),
                Consts::APP_ANILIBRIX => new AppItem(
                    Consts::APP_ANILIBRIX,
                    Consts::appTargets()[Consts::APP_ANILIBRIX],
                    'app_cross_anilibrix.png',
                    "AniLibriX",
                    "Отличный аниме-кинотеатр на твоем компьютере"
                ),
                Consts::APP_QT => new AppItem(
                    Consts::APP_QT,
                    Consts::appTargets()[Consts::APP_QT],
                    'app_cross_qt.png',
                    "AniLibria QT"
                )
            ];
        }

    }