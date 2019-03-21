<?php
/**
 * Bits plugin for Craft CMS 3.x
 *
 * A collection of simple, reusable components for use in your Craft Twig templates.
 *
 * @link      https://malven.co
 * @copyright Copyright (c) 2018 Chris Malven
 */

namespace malven\bits\twigextensions;

use malven\bits\Bits;

use Craft;

use craft\web\View;
use craft\helpers\Template;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Chris Malven
 * @package   Bits
 * @since     1.0.0
 */
class BitsTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Bits';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('someFilter', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('text', [$this, 'renderText']),
            new \Twig_SimpleFunction('textarea', [$this, 'renderTextarea']),
            new \Twig_SimpleFunction('selectable', [$this, 'renderSelectable']),
            new \Twig_SimpleFunction('btn', [$this, 'renderBtn']),
            new \Twig_SimpleFunction('validateClasses', [$this, 'renderValidateClasses']),
        ];
    }

    /**
     * Renders a generic text input.
     * 
     * See `/templates/macros.twig` for options.
     *
     * @param    array   $options
     *
     * @return   string
     */
    public function renderText($options = [])
    {
        return $this->renderTemplate('text', [$options]);
    }

    /**
     * Renders a generic textarea.
     * 
     * See `/templates/macros.twig` for options.
     *
     * @param    array   $options
     *
     * @return   string
     */
    public function renderTextarea($options = [])
    {
        return $this->renderTemplate('textarea', [$options]);
    }

    /**
     * Renders a generic checkbox or radio.
     * 
     * See `/templates/macros.twig` for options.
     *
     * @param    array   $options
     *
     * @return   string
     */
    public function renderSelectable($options = [])
    {
        return $this->renderTemplate('selectable', [$options]);
    }

    /**
     * Renders either an `a` or `button` element with identical structure.
     * 
     * See `/templates/macros.twig` for options.
     *
     * @param    array   $options
     *
     * @return   string
     */
    public function renderBtn($options = [])
    {
        return $this->renderTemplate('btn', [$options]);
    }

    /**
     * Validates that the given array of classes doesn't contain any
     * conflicting classes.
     *
     * See `/templates/macros.twig` for usage.
     *
     * @param    string  $classList       Space-separated list of classes to be assigned
     * @param    array   $allowedClasses  The allowed class combinations
     *
     * @return   string
     */
    public function renderValidateClasses($classList, $allowedClasses = [])
    {
        return $this->renderTemplate('validateClasses', [
            'classList' => $classList,
            'allowedClasses' => $allowedClasses
        ]);
    }

    public function renderTemplate($macro, $options = [])
    {
        $oldMode = \Craft::$app->view->getTemplateMode();
        \Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = \Craft::$app->view->renderTemplateMacro('bits/macros', $macro, $options);
        \Craft::$app->view->setTemplateMode($oldMode);
        return Template::raw($html);
    }
}
