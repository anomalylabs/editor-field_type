# Usage

- [Setting Values](#mutator)
- [Basic Output](#output)
- [Presenter Output](#presenter)

<hr>

<a name="mutator"></a>
## Setting Values

You can set the editor field type value with a string.

{{ code('php', '$entry->example = $html;') }}

You can also set the editor field type value by editing it's storage file. The the storage file is automatically synced with the database **and** vice versa.

The storage path can be found under the editor input _after_ the entry has been saved.

{{ img('anomaly.field_type.editor::img/docs/dump-path.jpg') }}

<hr>

<a name="output"></a>
## Basic Output

The editor field type returns the content's of the storage path by default. If there is newer database information a sync is made first _and then_ the content is returned.

{% code php %}
$entry->example; // File Contents
{% endcode %}

<hr>

<a name="presenter"></a>
## Presenter Output

When accessing the value from a decorated entry, like one in a view, the country field type presenter is returned instead.

#### Storage Path

Returns the editor's storage file path in prefix.

<div class="alert alert-primary">
<strong>Note:</strong> The path will use a registered path hint prefix instead of displaying the full path.
</div>

{% code php %}
$js = $entry->example->path(); // storage::the/storage/file.js

$asset->add('scripts.js', $js);

$view = $entry->another->path(); // storage::the/other/file.twig

$view->render($view);
{% endcode %}

#### Render

Return the storage file rendered through the view layer. An optional data payload can also be passed.

{% code php %}
$entry->example->render();      // The view output
$entry->example->render($data); // The view output with data
{% endcode %}

#### Parse

Return the storage file parsed through the view layer. Again, optional data payload can also be passed.

<div class="alert alert-primary">
<strong>Note:</strong> This is very different from loading the file as a view. For example, a JS storage file can be parsed but not loaded as a view.
</div>

{% code php %}
$entry->example->parse();      // The parsed output
$entry->example->parse($data); // The parsed output with data
{% endcode %}

#### Content

Return the storage file contents. If there is newer information in the database, it will be synced first.

{% code php %}
$entry->example->content(); // The storage file content
{% endcode %}
