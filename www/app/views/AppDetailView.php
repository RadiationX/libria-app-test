<?php


    namespace app\views;


    use app\common\BrowserInfo;
    use app\common\Consts;
    use app\common\Utils;
    use app\models\AppItem;
    use app\models\AppMapper;
    use app\models\detail\AppUpdate;
    use app\models\detail\AppModification;
    use app\models\view\detail\AppDetailViewModel;
    use app\models\view\detail\AppModViewModel;
    use app\sources\AppDetailSource;
    use Mustache_Engine;
    use Mustache_Template;

    class AppDetailView {

        private Mustache_Template $tpl;

        /**
         * AppDetailView constructor.
         * @param Mustache_Engine $mustache
         */
        public function __construct(Mustache_Engine $mustache) {
            $this->tpl = $mustache->loadTemplate("app-detail");
        }

        public function render(AppUpdate $appDetail, AppItem $appItem): string {
            $hasShown = false;
            $hasHidden = false;

            // Делаем выборку только по стабильному каналу и сортируем по ОС клиента
            $stableMods = array_filter(
                $appDetail->getModifications(),
                function (AppModification $mod) {
                    return $mod->getChannel() == Consts::CHANNEL_STABLE;
                }
            );
            $stableMods = array_values($stableMods);
            $stableMods = $this::sortByOrder($stableMods, [BrowserInfo::getOs()]);

            // Определяем, что есть модификации для ОС клиента
            foreach ($stableMods as $mod) {
                if ($mod->getOs() === BrowserInfo::getOs()) {
                    $hasShown = true;
                    break;
                }
            }

            $modViewModels = array_map(function ($mod) use ($appDetail, $appItem, &$hasShown, &$hasHidden) {
                $isHidden = $hasShown && $mod->getOs() !== BrowserInfo::getOs();
                if ($isHidden) {
                    $hasHidden = true;
                }
                return AppMapper::toModViewModel($mod, $appDetail, $appItem, $isHidden);
            }, $stableMods);
            $app = new AppDetailViewModel(
                $appItem->getId(),
                $appItem->getName(),
                $appItem->getDesc(),
                "/res/images/{$appItem->getImage()}",
                $modViewModels,
                $hasHidden
            );
            return $this->tpl->render($app);
        }

        /**
         * @param AppModification[] $array
         * @param string[] $order
         * @return AppModification[]
         */
        private function sortByOrder(array &$array, array $order): array {
            usort($array, function ($a, $b) use ($order) {
                foreach ($order as $value) {
                    if ($a->getOs() === $value) {
                        return 0;
                    }
                    if ($b->getOs() === $value) {
                        return 1;
                    }
                }
                return 0;
            });
            return $array;
        }

    }