<?php

    namespace Martin\Forms\Components;

    use Martin\Forms\Classes\MagicForm;

    class EmptyForm extends MagicForm {

        public function componentDetails() {
            return [
                'name'        => 'martin.forms::lang.components.empty_form.name',
                'description' => 'martin.forms::lang.components.empty_form.description',
            ];
        }

    }

?>