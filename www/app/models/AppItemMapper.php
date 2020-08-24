<?php


    namespace app\models;


    use app\common\AppTitleHelper;
    use app\common\AppUrlHelper;
    use app\common\BrowserInfo;
    use app\common\Utils;
    use app\models\view\AppItemViewModel;

    class AppItemMapper {

        public static function toViewModel(AppItem $item): AppItemViewModel {
            return new AppItemViewModel(
                $item->getId(),
                AppUrlHelper::getAppUrl($item->getId()),
                Utils::fileTime("/res/images/{$item->getImage()}"),
                Utils::fileTime("/res/icons/{$item->getIcon()}"),
                "unknown",
                AppTitleHelper::createTitle($item->getTarget())
            );
        }
    }