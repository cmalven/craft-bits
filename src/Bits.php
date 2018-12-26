<?php
/**
 * Bits plugin for Craft CMS 3.x
 *
 * A collection of simple, reusable components for use in your Craft Twig templates.
 *
 * @link      https://malven.co
 * @copyright Copyright (c) 2018 Chris Malven
 */

namespace malven\bits;

use malven\bits\variables\BitsVariable;
use malven\bits\twigextensions\BitsTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Bits provides helpful 
 *
 * @author    Chris Malven
 * @package   Bits
 * @since     1.0.0
 *
 */
class Bits extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Bits::$plugin
     *
     * @var Bits
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * Bits::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Add in our Twig extensions
        Craft::$app->view->registerTwigExtension(new BitsTwigExtension());

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('bits', BitsVariable::class);
            }
        );

        // Logging
        Craft::info(
            Craft::t(
                'bits',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
