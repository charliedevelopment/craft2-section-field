# Section Field

*Section Field* is a Craft CMS plugin that adds a field type for choosing sections. This allows content administrators to select from a configurable set of channels, structures, and singles. Entries using this field can then access these selections in their templates.

## Requirements

* Craft CMS 2.x

## Installation

1. Download the latest version of *Section Field*.
2. Move the `sectionfield` directory into the `craft/plugins/` directory.
3. In the Craft control panel, go to *Settings > Plugins*.
4. Find *Section Field* in the list of plugins and click the *Install* button.

## Usage

### Creating a Section Field

1. Create a new field.
2. Select *Section* as the field type.
3. Define which sections will be presented as options under *Allowed Sections*.
4. Check the *Allow Multiple* checkbox if applicable.
5. Attach the new field to a section.

### Editing a Section Field

The form controls for a section field are generated according to that individual field's configuration.

* If only one selection is allowed, the field is a set of radio buttons. If the field is not required, an additional "None" option is provided, and will be selected by default.

* If multiple selections are allowed, the field is a set of checkboxes. If the field is required, at least one box must be checked.

### Templating with a Section Field

In a Twig template, you can retrieve the data from a section field as you would from any other field type. If the field is configured to allow a single selection, it will provide the section ID as an integer. If the field is configured to allow multiple selections, it will provide the section ID(s) as an array.

See the example below, where `mySectionField` is a section field that determines which section(s) to display entries from.

```twig
{% set sections = entry.mySectionField %}

{% set entries = craft.entries.sectionId(sections) %}

{% for entry in entries %}

	{# Display entry #}

{% endfor %}
```

---

*Built for [Craft CMS](https://craftcms.com/) by [Charlie Development](http://charliedev.com/)*
