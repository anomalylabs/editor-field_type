## Introduction[](#introduction)

`anomaly.field_type.editor`

The editor field type provides a code editor input powered by [Ace](https://ace.c9.io/).


### Configuration[](#introduction/configuration)

Below is the full configuration available with defaults values:

    "example" => [
        "type"   => "anomaly.field_type.editor",
        "config" => [
            "default_value" => null,
            "mode"          => "twig",
            "height"        => 500,
            "word_wrap"     => null,
        ]
    ]

###### Properties

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Example</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

default_value

</td>

<td>

`<h3>Hello World</h3>`

</td>

<td>

The default value.

</td>

</tr>

<tr>

<td>

mode

</td>

<td>

css

</td>

<td>

The editor mode. Valid options can be found in the `editor.php` config file.

</td>

</tr>

<tr>

<td>

height

</td>

<td>

1000

</td>

<td>

The height of the editor.

</td>

</tr>

<tr>

<td>

word_wrap

</td>

<td>

`true`

</td>

<td>

Whether to wrap long lines of text or not.

</td>

</tr>

</tbody>

</table>


### Addon Configuration[](#introduction/addon-configuration)

The editor field type configures Ace options using it's `editor.php` config file.

You can override these options by publishing the addon and modifying the resulting configuration file:

    php artisan addon:publish anomaly.field_type.editor

The field type will be published to `/resources/{application}/addons/anomaly/editor-field_type`.

<div class="alert alert-success">**Success:** If you feel a popular mode is missing - add it to the config and send a pull request to [https://github.com/anomalylabs/editor-field_type](https://github.com/anomalylabs/editor-field_type)</div>


### Storage Files[](#introduction/storage-files)

The editor field type dumps content to a corresponding `storage file`. The path to this file will be visible underneath the editor when `app.debug` is enabled.

You can edit this file directly and it will automatically sync back and forth with the database value. This is for convenience only, never commit the storage directory.
