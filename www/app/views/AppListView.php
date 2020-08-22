<?php
    declare(strict_types=1);

    namespace app\views;

    use app\models\AppItem;
    use Mustache_Engine;
    use Mustache_LambdaHelper;
    use Mustache_Template;

    class AppListView {

        private AppItemView $itemView;
        private Mustache_Engine $mustache;
        private Mustache_Template $tplList;

        /**
         * AppListView constructor.
         * @param Mustache_Engine $mustache
         * @param AppItemView $itemView
         */
        public function __construct(
            Mustache_Engine $mustache,
            AppItemView $itemView
        ) {
            $this->mustache = $mustache;
            $this->itemView = $itemView;
            $this->tplList = $mustache->loadTemplate('app-list');
        }

        /**
         * @param AppItem[] $appList
         * @param string[] $clientAppKeys
         * @param string[] $otherAppKeys
         * @return string
         */
        public function render(
            array $appList,
            array $clientAppKeys,
            array $otherAppKeys
        ): string {
            return $this->tplList->render([
                'clientApps' => $clientAppKeys,
                'otherApps' => $otherAppKeys,
                'hasOther' => !empty($otherAppKeys),
                'itemTplWrapper' => function ($text, Mustache_LambdaHelper $helper) use ($appList) {
                    $appKey = trim($helper->render($text));
                    $app = $appList[$appKey];
                    return $this->itemView->render($app);
                }
            ]);
        }
    }