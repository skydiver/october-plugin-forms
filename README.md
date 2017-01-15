# Magic Forms for OctoberCMS
Create easy (and almost magic) AJAX forms.



## Why Magic Forms?
Almost everyday we do forms for our clients, personal projects, etc

Sometimes we need to add or remove fields, change validations, store data and at some point, this can be boring and repetitive.

So, the objective was to find a way to just put the html elements on the page, skip the repetitive task of coding and (with some kind of magic) store this data on a database or send by mail.



## Features
* Create any type of form: contact, feedback, registration, etc
* Write only HTML
* Don't code forms logic
* Laravel validation
* Custom validation errors
* Use multiple forms on same page
* Store on database
* Export data in CSV
* Access database records from backend
* Send mail notifications to multiple recipients
* Auto-response email on form submit
* reCAPTCHA validation



## Installation
In your OctoberCMS backend, go to Updates > Install plugins and search for "martin.forms"

**Alternative #1:** install from [October Marketplace](https://octobercms.com/plugins)

**Alternative #2:** from console, run: `php artisan plugin:install Martin.Forms`



## Usage
1. Drag selected component to your page.
2. Configure parameters.
3. Ready



## Components
**Generic AJAX Form**

By default renders a generic contact form to show the basic of Magic Forms.

Feel free to copy the included HTML and modify to fit your needs.


**Empty AJAX Form**

Create a empty template for your custom form; override HTML with your fields but remember to keep form tags and flash messages container.



## Validation
Form validation is independent for every component.

Just use [Laravel validation rules](https://laravel.com/docs/5.1/validation#available-validation-rules) as usual.

You can use as many as you want: ```required|alpha``` or ```required|email```



## Custom Validation Messages
Refer to Laravel documentation, [Working With Error Messages](https://laravel.com/docs/5.1/validation#working-with-error-messages).

Example: ```email.required``` or ```name.alpha```



## Security
Because the nature of Magic Forms, every form field received is stored.

This allows visitors to send extra fields. Although every received value is filtered, escaped and "secured", you may end having unsolicited stored data.

To prevent this scenario, on component configuration, there is a Security group with a property called "Allowed Fields"; put the names of your fields to process (one per line) and ingore anything not expected.
