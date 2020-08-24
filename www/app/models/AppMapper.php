<?php


    namespace app\models;


    use app\common\AppTitleHelper;
    use app\common\AppUrlHelper;
    use app\common\BrowserInfo;
    use app\common\Utils;
    use app\models\detail\AppDetail;
    use app\models\detail\AppModification;
    use app\models\view\AppItemViewModel;
    use app\models\view\BtnViewModel;
    use app\models\view\detail\AppModViewModel;

    class AppMapper {

        public static function toItemViewModel(AppItem $item, AppDetail $detail): AppItemViewModel {
            return new AppItemViewModel(
                $item->getId(),
                AppUrlHelper::getAppUrl($item->getId()),
                Utils::fileTime("/res/images/{$item->getImage()}"),
                Utils::fileTime("/res/icons/{$item->getIcon()}"),
                $detail->getName(),
                AppTitleHelper::createTitle($item->getTarget())
            );
        }

        public static function toModViewModel(
            AppModification $mod,
            AppDetail $detail,
            AppItem $appItem
        ): AppModViewModel {

            $source = $mod->getSources()[0];
            $title = AppTitleHelper::getTitle($mod->getOs());
            $primaryBtn = new BtnViewModel(
                $source->getLink(),
                "Скачать для $title",
                "/res/icons/{$appItem->getIcon()}",
                [BtnViewModel::CLASS_FILLED]
            );

            return new AppModViewModel($primaryBtn, []);
        }
    }