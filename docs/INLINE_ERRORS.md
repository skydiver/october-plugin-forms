# Inline Errors

Since version 1.3.7 you can display errors  with fields.

### Disabled
This is the normal behavior; display all fields errors.

### JS variable
Return the regular error message and append a new json property (error_fields) so you can do your own custom inline errors (using Angular, Vue.js).

### Display errors
Let the plugin display the inline errors using OctoberCMS core functionalities.

This function doesn't work out of the box because requires extra code.

Here is an example:

```
<form data-request="{{ __SELF__ }}::onFormSubmit" data-request-validate>

    {{ form_token() }}

    <div id="{{ __SELF__ }}_forms_flash"></div>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control">
        <div data-validate-for="name"></div>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" class="form-control">
        <div data-validate-for="email"></div>
    </div>
    
    <div class="form-group">
        {% partial '@recaptcha' %}
        <div data-validate-for="g-recaptcha-response"></div>
    </div>

    <button id="simpleContactSubmitButton" type="submit" class="btn btn-default">Submit</button>

</form>
```