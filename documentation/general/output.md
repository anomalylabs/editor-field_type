# Output

This field returns the storage file rendered through the view system if the storage file uses valid view extension.

If the storage file does NOT use a valid view extension then the contents of the file will be returned.

By default PHP, HTML, Twig, Markdown and Blade modes are supported by the view system.

### `path`

Returns the `storage::` prefixed path to the file. If the file is supported by the view system the path omit the extension.

```
// Twig Usage
{% include entry.example.path %}

// API usage
echo $entry->example->path;
```

### `storage_path`

Returns the non-prefixed path to the file including extension.

```
// Twig Usage
{% include entry.example.storage_path %}

// API usage
echo $entry->example->storage_path;
```

### `rendered`

Returns the storage file's rendered content. This method should only be used for files supported by the view system.

```
// Twig Usage
{{ entry.example.rendered|raw }}

// API usage
echo $entry->example->rendered;
```

### `parsed`

Returns the content of the storage passed through the parser. Use caution when allowing access to be parser.

```
// Twig Usage
{{ entry.example.parsed|raw }}

// API usage
$entry->example->parsed;
```

### `content`

Returns the content of the storage file.

```
// Twig Usage
{{ entry.example.content }}

// API usage
$entry->example->content;
```
