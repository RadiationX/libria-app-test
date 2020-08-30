<?php
    declare(strict_types=1);

    namespace app\views;

    use app\models\AppItem;
    use app\models\head\PageHeadData;
    use app\models\view\AppItemViewModel;
    use Mustache_Engine;
    use Mustache_LambdaHelper;
    use Mustache_Template;

    class ErrorView {

        private Mustache_Template $tplList;

        /**
         * AppListView constructor.
         * @param Mustache_Engine $mustache
         */
        public function __construct(Mustache_Engine $mustache) {
            $this->tplList = $mustache->loadTemplate('error');
        }

        /**
         * @param string $message
         * @return string
         */
        public function render(string $message): string {
            return $this->tplList->render([
                "message" => $message
            ]);
        }
    }