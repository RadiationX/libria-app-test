<?php


    namespace app\views;


    use app\common\Consts;
    use app\models\AppItem;
    use app\models\AppMapper;
    use app\models\detail\AppDetail;
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

        public function render(AppDetail $appDetail, AppItem $appItem): string {
            $stableMods = array_filter(
                $appDetail->getModifications(),
                function (AppModification $mod) {
                    return $mod->getChannel() == Consts::CHANNEL_STABLE;
                }
            );
            $stableMods = array_values($stableMods);
            $modViewModels = array_map(function ($mod) use ($appDetail, $appItem) {
                return AppMapper::toModViewModel($mod, $appDetail, $appItem);
            }, $stableMods);
            $app = new AppDetailViewModel(
                $appItem->getId(),
                $appDetail->getName(),
                $appDetail->getSlogan(),
                "/res/images/{$appItem->getImage()}",
                $modViewModels
            );
            return $this->tpl->render($app);
        }

    }