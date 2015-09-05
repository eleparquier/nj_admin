<?php
/**
 * Created by IntelliJ IDEA.
 * User: manu
 * Date: 24/08/15
 * Time: 20:48
 */

namespace fr\gilman\nj;


class Conf
{
    /**
     * @var array
     */
    private static $common = null;

    /**
     * @return string
     */
    public static function common(){
        return self::$common;
    }

    /**
     * @param string $path
     * @return void
     */
    public static function initCommon($path){
        if(is_null(self::$common)) {
            self::$common = parse_ini_file($path,true);
        }
    }
}