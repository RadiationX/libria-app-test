<?php


    namespace app\views;


    use Mustache_Engine;

    class BtnView {

        private \Mustache_Template $tpl;

        /**
         * BtnView constructor.
         * @param Mustache_Engine $mustache
         */
        public function __construct(Mustache_Engine $mustache) {
            $this->tpl = $mustache->loadTemplate("btn");
        }

        public function render(
            string $link,
            string $classes,
            string $text,
            ?string $icon = null
        ): string {
            return $this->tpl->render([
                "link" => $link,
                "classes" => $classes,
                "text" => $text,
                "icon" => $icon,
            ]);
        }

    }