# Security

### Allowed Fields

Because the nature of Magic Forms, every form field received is stored.

This allows visitors to send extra fields. Although every received value is filtered, escaped and "secured", you may end having unsolicited stored data.

To prevent this scenario, on component configuration, there is a Security group with a property called "Allowed Fields"; put the names of your fields to process (one per line) and ingore anything not expected.


### Sanitize form data

By default the plugin will run **htmlspecialchars** on every form field.

If you need to store raw data, you can disable this feature.
