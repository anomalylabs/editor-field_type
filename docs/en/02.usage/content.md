## Usage[](#usage)

This section will show you how to use the field type via API and in the view layer.


### Setting Values[](#usage/setting-values)

You can set the field type value with a string.

    $entry->example = $html;


### Basic Output[](#usage/basic-output)

The field type always returns the storage file content by default.

    $entry->example; // Raw contents of storage::example/input/file.js


### Presenter Output[](#usage/presenter-output)

This section will show you how to use the decorated value provided by the `\Anomaly\EditorFieldType\EditorFieldTypePresenter` class.


#### EditorFieldTypePresenter::path()[](#usage/presenter-output/editorfieldtypepresenter-path)

The `path` method returns the prefix hinted path to the storage file.

###### Returns: `string`

###### Example

    $decorated->example->path(); // storage::the/path/example.js

###### Twig

    {{ decorated.example.path() }} // storage::the/path/example.js


#### EditorFieldTypePresenter::render()[](#usage/presenter-output/editorfieldtypepresenter-render)

The `render` method returns the rendered view if the mode is `twig`, `blade`, or `html`.

###### Returns: `string`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$payload

</td>

<td>

false

</td>

<td>

array

</td>

<td>

null

</td>

<td>

Additional payload data for the view.

</td>

</tr>

</tbody>

</table>

###### Example

    $decorated->example->render(['name' => 'Ryan']);

###### Twig

    {{ decorated.example.render({'name': 'Ryan'})|raw }}


#### EditorFieldTypePresenter::parse()[](#usage/presenter-output/editorfieldtypepresenter-parse)

The `parse` method runs the file contents through the view engine. This is great for parsing Twig in `js` or other files.

###### Returns: `string`

###### Arguments

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Key</th>

<th>Required</th>

<th>Type</th>

<th>Default</th>

<th>Description</th>

</tr>

</thead>

<tbody>

<tr>

<td>

$payload

</td>

<td>

false

</td>

<td>

array

</td>

<td>

null

</td>

<td>

Additional payload data for the view.

</td>

</tr>

</tbody>

</table>

###### Example

    $decorated->example->parse(['name' => 'Ryan']);

###### Twig

    {{ decorated.example.parse({'name': 'Ryan'})|raw }}


#### EditorFieldTypePresenter::content()[](#usage/presenter-output/editorfieldtypepresenter-content)

The `content` method returns the raw value.

###### Returns: `string`

###### Example

    $decorated->example->content();

###### Twig

    {{ decorated.example.content() }}


#### EditorFieldTypePresenter::__toString()[](#usage/presenter-output/editorfieldtypepresenter-tostring)

The `__toString` method is mapped to `render` for `twig`, `blade`, and `html` files and mapped to `content` for everything else.

###### Returns: `string`

###### Example

    $decorated->example;

###### Twig

    {{ decorated.example|raw }}

<div class="alert alert-danger">**Heads Up:** The **__toString** will not properly display exceptions spurring from value content.</div>
