<?php

    declare(strict_types=1);

    namespace app\controllers;

    use app\common\AppsTargetHelper;
    use app\common\Consts;
    use app\models\AppMapper;
    use app\sources\AppDetailSource;
    use app\sources\AppItemSource;
    use app\views\AppListView;

    class AppListController {

        private AppListView $view;
        private AppItemSource $itemSource;
        private AppDetailSource $detailSource;

        /**
         * AppListController constructor.
         *
         * @param   AppListView      $view
         * @param   AppItemSource    $itemSource
         * @param   AppDetailSource  $detailSource
         */
        public function __construct(
            AppListView $view,
            AppItemSource $itemSource,
            AppDetailSource $detailSource
        ) {
            $this->view = $view;
            $this->itemSource = $itemSource;
            $this->detailSource = $detailSource;
        }

        function showList(): string {
            $appList = $this->itemSource->getList();
            $clientAppKeys = AppsTargetHelper::getClientAppKeys();
            $otherAppKeys = AppsTargetHelper::getOtherAppKeys();

            $clientAppKeys = array_filter($clientAppKeys, function ($key) {
                // winten deprecated
                return $key != Consts::APP_WINTEN;
            });
            $clientAppKeys = array_values($clientAppKeys);

            $otherAppKeys = array_filter($otherAppKeys, function ($key) {
                // winten deprecated
                return $key != Consts::APP_WINTEN;
            });
            $otherAppKeys = array_values($otherAppKeys);

            $clientApps = array_map(function ($key) use ($appList) {
                return AppMapper::toItemViewModel(
                    $appList[$key],
                    $this->detailSource->getDetail($key)
                );
            }, $clientAppKeys);

            $otherApps = array_map(function ($key) use ($appList) {
                return AppMapper::toItemViewModel(
                    $appList[$key],
                    $this->detailSource->getDetail($key)
                );
            }, $otherAppKeys);

            return $this->view->render($clientApps, $otherApps);
        }

    }

