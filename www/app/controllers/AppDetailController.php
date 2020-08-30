<?php


    namespace app\controllers;


    use app\common\AppTitleHelper;
    use app\common\AppUrlHelper;
    use app\common\Utils;
    use app\models\AppItem;
    use app\models\head\PageHeadData;
    use app\sources\AppDetailSource;
    use app\sources\AppItemSource;
    use app\views\AppDetailView;

    class AppDetailController {

        private AppDetailView $view;
        private AppDetailSource $detailSource;
        private AppItemSource $itemSource;
        private PageHeadData $headData;

        /**
         * AppDetailController constructor.
         * @param AppDetailView $view
         * @param AppDetailSource $detailSource
         * @param AppItemSource $itemSource
         * @param PageHeadData $headData
         */
        public function __construct(
            AppDetailView $view,
            AppDetailSource $detailSource,
            AppItemSource $itemSource,
            PageHeadData $headData
        ) {
            $this->view = $view;
            $this->detailSource = $detailSource;
            $this->itemSource = $itemSource;
            $this->headData = $headData;
        }

        public function showDetail(string $appId): string {
            $appItem = $this->itemSource->getList()[$appId];
            $this->fillPageData($appItem);
            $appDetail = $this->detailSource->getDetail($appId);
            return $this->view->render($appDetail, $appItem);
        }

        private function fillPageData(AppItem $appItem) {
            $hostPath = "https://{$_SERVER['HTTP_HOST']}";
            $title = $appItem->getName() . " для " . AppTitleHelper::createTitle($appItem->getTarget());
            $url = $hostPath . AppUrlHelper::getAppUrl($appItem->getId());
            $image = $hostPath . Utils::fileTime("/res/images/{$appItem->getImage()->getDefault()}");
            $this->headData->setTitle($title);
            $this->headData->setDescription($appItem->getDesc());
            $this->headData->getOpenGraph()
                ->setUrl($url)
                ->setImage($image);
        }
    }