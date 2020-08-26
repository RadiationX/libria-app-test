<?php


    namespace app\models;


    use app\common\AppTitleHelper;
    use app\common\AppUrlHelper;
    use app\common\BrowserInfo;
    use app\common\Resources;
    use app\common\Utils;
    use app\models\detail\AppUpdate;
    use app\models\detail\AppModification;
    use app\models\detail\AppSource;
    use app\models\view\AppItemViewModel;
    use app\models\view\BtnViewModel;
    use app\models\view\detail\AppModViewModel;
    use app\models\view\ImageViewModel;

    class AppMapper {

        public static function toItemViewModel(AppItem $item, ?AppUpdate $detail): AppItemViewModel {
            $icRes = Resources::APP_PRIMARY[$item->getId()];
            return new AppItemViewModel(
                $item->getId(),
                AppUrlHelper::getAppUrl($item->getId()),
                new ImageViewModel($item->getImage(), "app_image"),
                "/res/icons/{$icRes}",
                $item->getName(),
                AppTitleHelper::createTitle($item->getTarget())
            );
        }

        public static function toModViewModel(
            AppModification $mod,
            AppUpdate $detail,
            AppItem $appItem,
            bool $isHidden
        ): AppModViewModel {
            $titleParts = [AppTitleHelper::getTitle($mod->getOs())];

            foreach ($mod->getMustShownParams() as $paramKey) {
                $titleParts[] = $mod->getParams()[$paramKey];
            }

            foreach (array_keys($mod->getParams()) as $paramKey) {
                foreach ($detail->getModifications() as $value) {
                    if ($value !== $mod
                        && $value->getOs() === $mod->getOs()
                        && $value->getParams()[$paramKey] !== $mod->getParams()[$paramKey]) {
                        $titleParts[] = $mod->getParams()[$paramKey];
                        break;
                    }
                }
            }
            $titleParts = array_unique($titleParts);

            $source = $mod->getSources()[0];
            $title = join(" ", $titleParts);
            $icRes = Resources::OS_WHITE[$mod->getOs()];
            $primaryBtn = new BtnViewModel(
                $source->getLink(),
                "Скачать для $title",
                "/res/icons/{$icRes}",
                [BtnViewModel::CLASS_FILLED]
            );
            $otherBtns = self::getOtherBtns($mod);

            $classes = [];
            if ($isHidden) {
                $classes[] = AppModViewModel::CLASS_HIDDEN;
            }
            return new AppModViewModel($primaryBtn, $otherBtns, $classes);
        }

        /**
         * @param AppModification $mod
         * @return BtnViewModel[]
         */
        private static function getOtherBtns(AppModification $mod): array {
            $sources = array_slice($mod->getSources(), 1);
            return array_map(function (AppSource $source) {
                return new BtnViewModel(
                    $source->getLink(),
                    $source->getTitle(),
                    null,
                    [BtnViewModel::CLASS_SMALL, BtnViewModel::CLASS_SUB]
                );
            }, $sources);
        }
    }