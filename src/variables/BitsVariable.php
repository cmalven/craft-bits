<?php
/**
 * Bits plugin for Craft CMS 3.x
 *
 * A collection of simple, reusable components for use in your Craft Twig templates.
 *
 * @link      https://malven.co
 * @copyright Copyright (c) 2018 Chris Malven
 */

namespace malven\bits\variables;

use malven\bits\Bits;

use Craft;

/**
 * Bits Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.bits }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Chris Malven
 * @package   Bits
 * @since     1.0.0
 */
class BitsVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.bits.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.bits.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }
}
