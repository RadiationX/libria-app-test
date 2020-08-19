<?php

    class Utils {

        /**
         * @param $variable
         * @param callable $fn
         * @return mixed
         */
        public static function lazyInit($variable, $fn) {
            if ($variable == null && is_callable($fn)) {
                $variable = call_user_func($fn);
            }
            return $variable;
        }
    }

