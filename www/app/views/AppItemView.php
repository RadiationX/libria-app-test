<?php
    declare(strict_types=1);

    namespace app\views;

    use app\models\AppItem;
    use Mustache_Engine;
    use Mustache_Template;

    class AppItemView {

        private Mustache_Template $tpl;

        /**
         * AppItemView constructor.
         * @param Mustache_Engine $mustache
         */
        public function __construct(Mustache_Engine $mustache) {
            $this->tpl = $mustache->loadTemplate('app-item');
        }

        public function render(AppItem $app): string {
            return $this->tpl->render($app);
        }
    }