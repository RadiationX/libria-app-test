<?php
    declare(strict_types=1);

    namespace app\views;

    use app\common\AppTitleHelper;
    use app\common\AppUrlHelper;
    use app\common\Utils;
    use app\models\AppItem;
    use app\models\head\PageHeadData;
    use app\models\view\AppItemViewModel;
    use app\models\view\head\OpenGraphViewModel;
    use app\models\view\head\PageHeadViewModel;
    use Mustache_Engine;
    use Mustache_LambdaHelper;
    use Mustache_Template;

    class PageHeadView {

        private Mustache_Template $tplList;

        /**
         * PageHeadView constructor.
         * @param Mustache_Engine $mustache
         */
        public function __construct(Mustache_Engine $mustache) {
            $this->tplList = $mustache->loadTemplate('page-head');
        }

        /**
         * @param PageHeadData $headData
         * @return string
         */
        public function render(PageHeadData $headData): string {
            $hostPath = "https://{$_SERVER['HTTP_HOST']}";
            $og = $headData->getOpenGraph();
            $url = $hostPath . $og->getUrl();
            $image = $hostPath . Utils::fileTime("/res/images/{$og->getImage()}");

            $ogViewModel = new OpenGraphViewModel(
                $og->getTitle(),
                $og->getDescription(),
                $og->getSiteName(),
                $image,
                $url
            );

            $headViewModel = new PageHeadViewModel(
                $headData->getTitle(),
                $headData->getDescription(),
                $ogViewModel
            );
            return $this->tplList->render($headViewModel);
        }
    }