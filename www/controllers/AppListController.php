<?php


    class AppListController {

        private AppListView $view;
        private AppListSource $source;
        private AppsTargetHelper $targetHelper;

        /**
         * AppListController constructor.
         * @param AppListView $view
         * @param AppListSource $source
         * @param AppsTargetHelper $targetHelper
         */
        public function __construct(
            AppListView $view,
            AppListSource $source,
            AppsTargetHelper $targetHelper
        ) {
            $this->view = $view;
            $this->source = $source;
            $this->targetHelper = $targetHelper;
        }

        /**
         * @return string
         */
        function showList() {
            $appList = $this->source->getList();
            $clientAppKeys = $this->targetHelper->getClientAppKeys();
            $otherAppKeys = $this->targetHelper->getOtherAppKeys();
            return $this->view->render($appList, $clientAppKeys, $otherAppKeys);
        }
    }

