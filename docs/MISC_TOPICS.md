# Misc Topics



## Use stored data on front-end

Here is an example to use your data on the public page.

Put this code on the [PHP code section](https://octobercms.com/docs/cms/themes#php-section) of your page:
```
use \Martin\Forms\Models\Record as FormsRecords;
function onStart() {
    $this['records'] = FormsRecords::all();
}
```
And this goes in your page:
```
<ul>
{% for record in records %}
    <li>{{ record.form_data_arr.name }}</li>
    <li>{{ record.form_data_arr.email }}</li>
    <li>{{ record.form_data_arr.another_field }}</li>
{% endfor %}
</ul>
```

\* Note the custom attribute **form_data_arr**, the stored data are converted to a PHP array.



## Multiple checkboxes

You can create an array of checkboxes like:
```
<input type="checkbox" name="color[]" value="red"   />Red
<input type="checkbox" name="color[]" value="blue"  />Blue
<input type="checkbox" name="color[]" value="green" />Green
```



## Using variables on notification email

It's possible to use variables of the submited form on your email subject.

1. Goto your page or partial
2. Click on Magic Form component
3. Expand "Notification Settings"
4. On "Subject", you can use the following variables:

```
{{ record.id }}      # the record id stored on the database
{{ record.ip }}      # the ip address of the sender
{{ record.date }}    # date when form was submitted

{{ form.xxx }}       # where "xxx" is the name of an existing form field
{{ form.full_name }} # the value of the field with attribute name="full_name"
```

Examples:
* `New mail with ID: {{ record.id }}`
* `Form submitted from IP: {{ record.ip }}`
* `Contact from: {{ form.name }} {{ form.last }}`
