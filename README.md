# Bits plugin for Craft CMS 3.x

A collection of simple, reusable components for use in your Craft Twig templates.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require malven/craft-bits

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Bits.

## Components

### Forms

#### Text

```twig
{{ text({
  mainClass: 'input-text',
  classes: '',
  showLabel: true,
  name: 'email',
  label: 'Email',
  value: '',
  type: 'text',
  placeholder: 'someone@gmail.com',
  autocomplete: false,
  errors: ['Some error message'],
  disabled: false,
  required: false,
  inputAttrs: {
    'minlength': 1,
    'maxlength': 5
  }
}) }}

```

#### Textarea

```twig
{{ textarea({
  mainClass: 'input-textarea',
  classes: '',
  showLabel: true,
  name: 'comment',
  label: 'Comment',
  value: '',
  placeholder: 'The quick brown fox jumped over the lazy dog.',
  autocomplete: false,
  errors: ['Some error message'],
  disabled: false,
  required: false,
  inputAttrs: {
    'rows': 3
  }
}) }}

```

#### Selectable

A `selectable` renders either a `checkbox` or `radio` element, depending on the supplied `type`.

```twig
{{ selectable({
  mainClass: 'input-selectable',
  classes: '',
  name: 'options',
  label: 'Options',
  type: 'checkbox|radio',
  unselectedSvg: '<svg … />',
  selectedSvg: '<svg … />'',
  items: [
    {
      label: 'Burgers',
      value: 'burgers',
      selected: false
    },
    {
      label: 'Pizza',
      value: 'pizza',
      selected: false
    }
  ],
  required: false
}) }}
```

## Customization

If you want to use Bits components directly as described in the examples above, that’s just fine. However, you may find it valuable to create your own custom components that provide a thin layer of abstraction over Bits, making them more plug-and-play for your project.

Here’s an example:

`my-project/templates/_macros/forms.twig`

```twig
{# =============================================================== #}
{# Forms
{# =============================================================== #}
{#
  {% import '_macros/forms' as forms %}
#}

{# ------------------------------------------------------------------ #}
{# Input: Text
{# ------------------------------------------------------------------ #}
{#
  {{ forms.inputText({}) }}

  Renders a common text input.
#}

{%- macro inputText(options = {}) -%}

{% set options = options | merge({
  mainClass: 'my-custom-input'
}) %}

{{ text(options) }}

{%- endmacro -%}
```

`my-project/templates/index.twig`

```twig
{% import '_macros/forms' as forms %}

{{ forms.inputText({
  name: 'firstName',
  label: 'First Name',
  value: '',
  placeholder: 'someone@gmail.com'
}) }}
```

Now every time you call your custom macro, you can pass it any of the same options you would pass directly to Bits, but you can be sure that it will always have the correct class and default options applied.

Brought to you by [Chris Malven](https://malven.co)
