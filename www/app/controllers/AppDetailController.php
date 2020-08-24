<?php


    namespace app\controllers;


    use app\sources\AppDetailSource;
    use app\sources\AppItemSource;
    use app\views\AppDetailView;

    class AppDetailController {

        private AppDetailView $view;
        private AppDetailSource $detailSource;
        private AppItemSource $itemSource;

        /**
         * AppDetailController constructor.
         * @param AppDetailView $view
         * @param AppDetailSource $detailSource
         * @param AppItemSource $itemSource
         */
        public function __construct(
            AppDetailView $view,
            AppDetailSource $detailSource,
            AppItemSource $itemSource
        ) {
            $this->view = $view;
            $this->detailSource = $detailSource;
            $this->itemSource = $itemSource;
        }


        public function showDetail(string $appId): string {
            $appItem = $this->itemSource->getList()[$appId];
            $appDetail = $this->detailSource->getDetail($appId);
            return $this->view->render($appDetail, $appItem);
        }
    }