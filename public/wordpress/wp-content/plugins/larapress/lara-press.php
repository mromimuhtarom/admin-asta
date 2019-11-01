<?php
/*
Plugin Name: LaraPress
Plugin URI: http://www.graphem.ca
Description: This plugin load Laravel into Wordpress so you can access the all the Laravel Framework inside your Wordpress Theme
Version: 0.1
Author: Graph'em Solutions Inc.
Author URI: http://www.graphem.ca
*/
namespace WPLaravelBoostrap;

use WPLaravelBoostrap\WPCore\admin\WPadminNotice;
use WPLaravelBoostrap\WPCore\View;
use WPLaravelBoostrap\WPCore\WPplugin;
use WPLaravelBoostrap\LaravelBootstrap\FLaravelBootstrap;

require 'autoload.php';

class LaravelBootstrap extends WPplugin
{

    public static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        load_plugin_textdomain('lara-press', false, dirname(plugin_basename(__FILE__)).'/lang');

        parent::__construct(__FILE__, 'Laravel Bootstrap', 'lara-press');
        
        $this->setReqWpVersion("3.5");
        $this->setReqWPMsg(sprintf(__('%s Requirements failed. WP version must at least %s', 'lara-press'), $this->getName(), $this->reqWPVersion));
        $this->setReqPhpVersion("5.3.3");
        $this->setReqPHPMsg(sprintf(__('%s Requirements failed. PHP version must at least %s', 'lara-press'), $this->getName(), $this->reqPHPVersion));
               
        $this->setMainFeature(FLaravelBootstrap::getInstance());
        parent::init();
    }
}
$LaravelBootstrap = LaravelBootstrap::getInstance();
$LaravelBootstrap->register();
