# Output

This field type returns the content of the editor.

**Examples:**

### `path`

Return the applicable path.

```
// Twig Usage
{{ entry.example.path }}

// API Usage
$entry->example->path();
```

### `render`

Return the rendered content.

```
// Twig Usage
{{ entry.example.render }}

// API Usage
$entry->example->render();
```

### `parse`

Return the parsed content.

```
// Twig Usage
{{ entry.example.parse }}

// API Usage
$entry->example->parse();
```
