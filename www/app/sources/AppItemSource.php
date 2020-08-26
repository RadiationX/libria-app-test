<?php
    declare(strict_types=1);

    namespace app\sources;

    use app\common\Consts;
    use app\common\Utils;
    use app\models\AppItem;
    use app\models\ImageBuilder;
    use app\models\MultiImage;

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
                    MultiImage::from("app_android_mobile-w840.jpg")
                        ->with(1, "app_android_mobile-w480.jpg")
                        ->with(2, "app_android_mobile-w840.jpg"),
                    "AniLibria",
                    "Удобное Android приложение для просмотра аниме"
                ),
                Consts::APP_ANDROID_TV => new AppItem(
                    Consts::APP_ANDROID_TV,
                    Consts::appTargets()[Consts::APP_ANDROID_TV],
                    MultiImage::from("app_android_tv-w840.jpg")
                        ->with(1, "app_android_tv-w480.jpg")
                        ->with(2, "app_android_tv-w840.jpg"),
                    "AniLibria TV",
                    "То, что нужно, для просмотра аниме на диване"
                ),
                Consts::APP_IOS => new AppItem(
                    Consts::APP_IOS,
                    Consts::appTargets()[Consts::APP_IOS],
                    MultiImage::from("app_ios-w840.jpg")
                        ->with(1, "app_ios-w480.jpg")
                        ->with(2, "app_ios-w840.jpg"),
                    "AniLibria",
                    "Удобное iOS приложение для просмотра аниме"
                ),
                Consts::APP_MACOS_CATALYST => new AppItem(
                    Consts::APP_MACOS_CATALYST,
                    Consts::appTargets()[Consts::APP_MACOS_CATALYST],
                    MultiImage::from("app_macos_catalyst-w840.jpg")
                        ->with(1, "app_macos_catalyst-w480.jpg")
                        ->with(2, "app_macos_catalyst-w840.jpg"),
                    "AniLibria Catalyst",
                    "[Экспериментально] iOS приложение, портированное на macOS"
                ),
                Consts::APP_WINTEN => new AppItem(
                    Consts::APP_WINTEN,
                    Consts::appTargets()[Consts::APP_WINTEN],
                    MultiImage::from("app_winten-w840.jpg")
                        ->with(1, "app_winten-w480.jpg")
                        ->with(2, "app_winten-w840.jpg"),
                    "AniLibria",
                    "Специально для Windows 10"
                ),
                Consts::APP_ANILIBRIX => new AppItem(
                    Consts::APP_ANILIBRIX,
                    Consts::appTargets()[Consts::APP_ANILIBRIX],
                    MultiImage::from("app_cross_anilibrix-w840.jpg")
                        ->with(1, "app_cross_anilibrix-w480.jpg")
                        ->with(2, "app_cross_anilibrix-w840.jpg"),
                    "AniLibriX",
                    "Отличный аниме-кинотеатр на любого вашего компьютера"
                ),
                Consts::APP_QT => new AppItem(
                    Consts::APP_QT,
                    Consts::appTargets()[Consts::APP_QT],
                    MultiImage::from("app_cross_qt-w840.jpg")
                        ->with(1, "app_cross_qt-w480.jpg")
                        ->with(2, "app_cross_qt-w840.jpg"),
                    "AniLibria QT",
                    "Отличный аниме-кинотеатр на любого вашего компьютера"
                )
            ];
        }

    }