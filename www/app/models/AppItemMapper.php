<?php


    namespace app\models;


    use app\common\Utils;
    use app\models\view\AppItemViewModel;

    class AppItemMapper {

        public static function toViewModel(AppItem $item): AppItemViewModel {
            return new AppItemViewModel(
                $item->getId(),
                $item->getLink(),
                Utils::fileTime("/res/images/{$item->getImage()}"),
                Utils::fileTime("/res/icons/{$item->getIcon()}"),
                $item->getName(),
                $item->getPlatforms()
            );
        }
    }