# Editor Field Type

*anomaly.field_type.editor*

### An editor field type powered by Ace.

The editor field type provides a rich editor input powered by Ace.

### Note

- This field type stores information in your storage directory at `storage/streams/{app_ref}/{namespace}/{stream}/{entry_id}/filename.extension`.
- This field type will always use the value from the storage directory.
- If no storage file exists the value from the database will be dumped to file, then used.
- Some modes may not save with the proper file extension. If you come across an extension that needs corrected please submit a pull request.
