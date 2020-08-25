<?php


    namespace app\models;


    use app\common\AppTitleHelper;
    use app\common\AppUrlHelper;
    use app\common\BrowserInfo;
    use app\common\Resources;
    use app\common\Utils;
    use app\models\detail\AppDetail;
    use app\models\detail\AppModification;
    use app\models\view\AppItemViewModel;
    use app\models\view\BtnViewModel;
    use app\models\view\detail\AppModViewModel;

    class AppMapper {

        public static function toItemViewModel(AppItem $item, ?AppDetail $detail): AppItemViewModel {
            $name = "Unknown";
            if ($detail != null) {
                $name = $detail->getName();
            }
            return new AppItemViewModel(
                $item->getId(),
                AppUrlHelper::getAppUrl($item->getId()),
                Utils::fileTime("/res/images/{$item->getImage()}"),
                Utils::fileTime("/res/icons/{$item->getIcon()}"),
                $name,
                AppTitleHelper::createTitle($item->getTarget())
            );
        }

        public static function toModViewModel(
            AppModification $mod,
            AppDetail $detail,
            AppItem $appItem,
            bool $isHidden
        ): AppModViewModel {
            $titleParts = [AppTitleHelper::getTitle($mod->getOs())];

            foreach ($detail->getModifications() as $value) {
                if ($value !== $mod
                    && $value->getOs() === $mod->getOs()
                    && $value->getAbi() !== $mod->getAbi()) {
                    $titleParts[] = $mod->getAbi();
                    break;
                }
            }
            foreach ($detail->getModifications() as $value) {
                if ($value !== $mod
                    && $value->getOs() === $mod->getOs()
                    && $value->getMinOsVersion() !== $mod->getMinOsVersion()) {
                    $titleParts[] = $mod->getMinOsVersion();
                    break;
                }
            }

            $source = $mod->getSources()[0];
            $title = join(" ", $titleParts);
            $icRes = Resources::OS_WHITE[$mod->getOs()];
            $primaryBtn = new BtnViewModel(
                $source->getLink(),
                "Скачать для $title",
                "/res/icons/{$icRes}",
                [BtnViewModel::CLASS_FILLED]
            );

            $classes = [];
            if ($isHidden) {
                $classes[] = AppModViewModel::CLASS_HIDDEN;
            }
            return new AppModViewModel($primaryBtn, [], $classes);
        }
    }