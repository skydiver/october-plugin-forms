# Uploads [BETA]

```
Note: AJAX file uploads are available since version 1.3.0
```

---

### Frontend

1. Insert the "Upload AJAX Form" component on your page
2. Allow uploads on component properties on "Uploader settings" group (configure the remaining options as needed)
3. Override component HTML with your form | ([more info](https://octobercms.com/docs/cms/components#overriding-partials))
  * If your component alias is **"uploadForm"** then you need to create a new partial called **"uploadForm/default.htm"**
4. Use this basic template and replace `<!-- YOUR FORM FIELDS -->` with your HTML fields:

```
{{ form_ajax(__SELF__ ~ '::onFormSubmit') }}
    <div id="{{ __SELF__ }}_forms_flash"></div>
    <!-- YOUR FORM FIELDS -->
    {% partial '@file-upload' %}
    {% partial '@recaptcha' %}
    {{ form_submit() }}
{{ form_close() }}
```

---

### Backend
Uploads are accesible from the record view on the backend (Magic Forms > Records).

---

### Mail Attachements
You can send uploaded files as mail attachments, just select the option on: component properties > Notification Settings > Send Uploads

---