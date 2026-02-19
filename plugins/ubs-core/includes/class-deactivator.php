<?php

class UBS_Core_Deactivator {

    public static function deactivate() {
        flush_rewrite_rules();
    }

}
