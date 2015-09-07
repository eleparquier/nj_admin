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
     * @var array
     */
    private static $path = null;

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

    /**
     * @return string
     */
    public static function path(){
        return self::$path;
    }

    /**
     * @param string $path
     * @return void
     */
    public static function initPath($path){
        if(is_null(self::$path)) {
            self::$path = parse_ini_file($path,true);
        }
    }
}