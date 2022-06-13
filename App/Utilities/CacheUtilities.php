<?php
namespace App\Utilities;

class CacheUtilities{

    protected static $cache_file;
    protected static $cache_enabled=0;
    const EXPIRED_TIME=3600;

    public static function init()
    {
      self::$cache_file=CACHE_DIR ."/". md5($_SERVER['REQUEST_URI']).".json";
        if($_SERVER['REQUEST_METHOD'] !== 'GET'){
            self::$cache_enabled=0;
        }  
    }

    public static function cache_exist()
    {    
        self::init();
        return (file_exists(self::$cache_file) and (time() - self::EXPIRED_TIME) < filemtime(self::$cache_file));
                
    }

    public static function start()
    {
        if(!self::$cache_enabled){
            return;
        }
        if(file_exists(self::$cache_file) and (time() - self::EXPIRED_TIME) < filemtime(self::$cache_file)){
            readfile(self::$cache_file);
            exit;
        }

        ob_start();
    }

    public static function end()
    {
        if(!self::$cache_enabled){
            return;
        }

        $file_path=fopen(self::$cache_file,'w');
        fwrite($file_path,ob_get_contents());
        fclose($file_path);

        ob_end_flush();
    }

    public static function flush()
    {
        $files=glob(CACHE_DIR."*");

        foreach($files as $file){
            if(is_file($file)){
                unlink($file);
            }
        }
        
    }
}