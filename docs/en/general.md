# Editor Field Type

- [Introduction](#introduction)
- [Configuration](#configuration)
- [Output](#output)


<a name="introduction"></a>
## Introduction

`anomaly.field_type.editor`

The editor field type provides a rich editor input powered by Ace.

### Notes

- This field type stores information in your storage directory at `storage/streams/{app_ref}/{namespace}/{stream}/{entry_id}/filename.extension`.
- This field type will always use the value from the storage directory.
- If no storage file exists the value from the database will be dumped to file, then used.
- Some modes may not save with the proper file extension. If you come across an extension that needs corrected please submit a pull request.


<a name="configuration"></a>
## Configuration

**Example Definition:**

    protected $fields = [
        'example' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 500
            ]
        ]
    ];

### `mode`

The language mode for the editor. The language mode determines syntax highlighting, code completion and the extension for the storage file.

Valid options are:

    'abap'         => 'ABAP',
    'actionscript' => 'ActionScript',
    'ada'          => 'ADA',
    'apache_conf'  => 'Apache Conf',
    'asciidoc'     => 'AsciiDoc',
    'assembly_x86' => 'Assembly x86',
    'autohotkey'   => 'AutoHotKey',
    'batchfile'    => 'BatchFile',
    'c9search'     => 'C9Search',
    'c_cpp'        => 'C and C++',
    'cirru'        => 'Cirru',
    'clojure'      => 'Clojure',
    'cobol'        => 'Cobol',
    'coffee'       => 'CoffeeScript',
    'coldfusion'   => 'ColdFusion',
    'csharp'       => 'C#',
    'css'          => 'CSS',
    'curly'        => 'Curly',
    'd'            => 'D',
    'dart'         => 'Dart',
    'diff'         => 'Diff',
    'dockerfile'   => 'Dockerfile',
    'dot'          => 'Dot',
    'dummy'        => 'Dummy',
    'dummysyntax'  => 'DummySyntax',
    'eiffel'       => 'Eiffel',
    'ejs'          => 'EJS',
    'elixir'       => 'Elixir',
    'elm'          => 'Elm',
    'erlang'       => 'Erlang',
    'forth'        => 'Forth',
    'ftl'          => 'FreeMarker',
    'gcode'        => 'Gcode',
    'gherkin'      => 'Gherkin',
    'gitignore'    => 'Gitignore',
    'glsl'         => 'Glsl',
    'golang'       => 'Go',
    'groovy'       => 'Groovy',
    'haml'         => 'HAML',
    'handlebars'   => 'Handlebars',
    'haskell'      => 'Haskell',
    'haxe'         => 'haXe',
    'html'         => 'HTML',
    'html_ruby'    => 'HTML (Ruby)',
    'ini'          => 'INI',
    'io'           => 'Io',
    'jack'         => 'Jack',
    'jade'         => 'Jade',
    'java'         => 'Java',
    'javascript'   => 'JavaScript',
    'json'         => 'JSON',
    'jsoniq'       => 'JSONiq',
    'jsp'          => 'JSP',
    'jsx'          => 'JSX',
    'julia'        => 'Julia',
    'latex'        => 'LaTeX',
    'less'         => 'LESS',
    'liquid'       => 'Liquid',
    'lisp'         => 'Lisp',
    'livescript'   => 'LiveScript',
    'logiql'       => 'LogiQL',
    'lsl'          => 'LSL',
    'lua'          => 'Lua',
    'luapage'      => 'LuaPage',
    'lucene'       => 'Lucene',
    'makefile'     => 'Makefile',
    'markdown'     => 'Markdown',
    'mask'         => 'Mask',
    'matlab'       => 'MATLAB',
    'mel'          => 'MEL',
    'mushcode'     => 'MUSHCode',
    'mysql'        => 'MySQL',
    'nix'          => 'Nix',
    'objectivec'   => 'Objective-C',
    'ocaml'        => 'OCaml',
    'pascal'       => 'Pascal',
    'perl'         => 'Perl',
    'pgsql'        => 'pgSQL',
    'php'          => 'PHP',
    'powershell'   => 'Powershell',
    'praat'        => 'Praat',
    'prolog'       => 'Prolog',
    'properties'   => 'Properties',
    'protobuf'     => 'Protobuf',
    'python'       => 'Python',
    'r'            => 'R',
    'rdoc'         => 'RDoc',
    'rhtml'        => 'RHTML',
    'ruby'         => 'Ruby',
    'rust'         => 'Rust',
    'sass'         => 'SASS',
    'scad'         => 'SCAD',
    'scala'        => 'Scala',
    'scheme'       => 'Scheme',
    'scss'         => 'SCSS',
    'sh'           => 'SH',
    'sjs'          => 'SJS',
    'smarty'       => 'Smarty',
    'snippets'     => 'snippets',
    'soy_template' => 'Soy Template',
    'space'        => 'Space',
    'sql'          => 'SQL',
    'stylus'       => 'Stylus',
    'svg'          => 'SVG',
    'tcl'          => 'Tcl',
    'tex'          => 'Tex',
    'text'         => 'Text',
    'textile'      => 'Textile',
    'toml'         => 'Toml',
    'twig'         => 'Twig',
    'typescript'   => 'Typescript',
    'vala'         => 'Vala',
    'vbscript'     => 'VBScript',
    'velocity'     => 'Velocity',
    'verilog'      => 'Verilog',
    'vhdl'         => 'VHDL',
    'xml'          => 'XML',
    'xquery'       => 'XQuery',
    'yaml'         => 'YAML'

### `theme`

The editor theme.

Valid options are:

    'chrome'                  => 'Chrome',
    'clouds'                  => 'Clouds',
    'crimson_editor'          => 'Crimson Editor',
    'dawn'                    => 'Dawn',
    'dreamweaver'             => 'Dreamweaver',
    'eclipse'                 => 'Eclipse',
    'github'                  => 'GitHub',
    'solarized_light'         => 'Solarized Light',
    'textmate'                => 'TextMate',
    'tomorrow'                => 'Tomorrow',
    'xcode'                   => 'XCode',
    'kuroir'                  => 'Kuroir',
    'katzenmilch'             => 'KatzenMilch',
    'ambiance'                => 'Ambiance',
    'chaos'                   => 'Chaos',
    'clouds_midnight'         => 'Clouds Midnight',
    'cobalt'                  => 'Cobalt',
    'idle_fingers'            => 'idle Fingers',
    'kr_theme'                => 'krTheme',
    'merbivore'               => 'Merbivore',
    'merbivore_soft'          => 'Merbivore Soft',
    'mono_industrial'         => 'Mono Industrial',
    'monokai'                 => 'Monokai',
    'pastel_on_dark'          => 'Pastel on dark',
    'solarized_dark'          => 'Solarized Dark',
    'terminal'                => 'Terminal',
    'tomorrow_night'          => 'Tomorrow Night',
    'tomorrow_night_blue'     => 'Tomorrow Night Blue',
    'tomorrow_night_bright'   => 'Tomorrow Night Bright',
    'tomorrow_night_eighties' => 'Tomorrow Night 80s',
    'twilight'                => 'Twilight',
    'vibrant_ink'             => 'Vibrant Ink'

### `height`

Height of the editor in pixels. The default value is `500`.


<a name="output"></a>
## Output

This field returns the storage file rendered through the view system if the storage file has a valid view extension.

If the storage file does NOT use a valid view extension then the contents of the file will be returned.

By default PHP, HTML, Twig, Markdown and Blade modes are supported by the view system.

### `path()`

Returns the `storage::` prefixed path to the file. If the file is supported by the view system the path omit the extension.

    // Twig usage
    {% include entry.example.path %}
    
    // API usage
    echo $entry->example->path;

### `storagePath()`

Returns the non-prefixed path to the file including extension.

    // Twig usage
    {% include entry.example.storage_path %}
    
    // API usage
    echo $entry->example->storagePath();

### `rendered()`

Returns the storage file's rendered content. This method should only be used for files supported by the view system.

    // Twig usage
    {{ entry.example.rendered|raw }}
    
    // API usage
    echo $entry->example->rendered;

### `parsed()`

Returns the content of the storage passed through the parser. Use caution when allowing access to be parser.

    // Twig usage
    {{ entry.example.parsed|raw }}
    
    // API usage
    $entry->example->parsed;

### `content()`

Returns the content of the storage file.

    // Twig usage
    {{ entry.example.content }}
    
    // API usage
    $entry->example->content;
