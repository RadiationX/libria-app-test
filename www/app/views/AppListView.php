<?php
    declare(strict_types=1);

    namespace app\views;

    use app\models\AppItem;
    use app\models\view\AppItemViewModel;
    use Mustache_Engine;
    use Mustache_LambdaHelper;
    use Mustache_Template;

    class AppListView {

        private Mustache_Template $tplList;

        /**
         * AppListView constructor.
         * @param Mustache_Engine $mustache
         */
        public function __construct(Mustache_Engine $mustache) {
            $this->tplList = $mustache->loadTemplate('app-list');
        }

        /**
         * @param AppItemViewModel[] $clientApps
         * @param AppItemViewModel[] $otherApps
         * @return string
         */
        public function render(
            array $clientApps,
            array $otherApps
        ): string {
            return $this->tplList->render([
                'clientApps' => $clientApps,
                'otherApps' => $otherApps,
                'hasOther' => !empty($otherApps)
            ]);
        }
    }