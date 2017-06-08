# Events



The plugin adds a few events:

* beforeSaveRecord
* afterSaveRecord


Just add the event listen to the boot method of your plugin:

```
public function boot() {

    Event::listen('martin.forms.beforeSaveRecord', function (&$formdata) {

        $formdata['somefield'] = "NEW VALUE";

    });

    Event::listen('martin.forms.afterSaveRecord', function (&$formdata) {

        var_dump($formdata);

    });

}
```


Also, you can override the form data before it's stored to the database.

More info on this: [PR#63](https://github.com/skydiver/october-plugin-forms/pull/63) and [oc-plugin-rwm-mfcontactsview](https://github.com/therealkevinard/oc-plugin-rwm-mfcontactsview)