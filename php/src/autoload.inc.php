<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoloadf58a9d4c4b88a9fd62b4160e9af58c85($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'paydatecalculator' => '/PaydateCalculator.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoloadf58a9d4c4b88a9fd62b4160e9af58c85', true);
// @codeCoverageIgnoreEnd
