<?php

    namespace BlakeJones\MagicForms\Components;

    use BlakeJones\MagicForms\Classes\MagicForm;

    class EmptyForm extends MagicForm {

        public function componentDetails() {
            return [
                'name'        => 'blakejones.magicforms::lang.components.empty_form.name',
                'description' => 'blakejones.magicforms::lang.components.empty_form.description',
            ];
        }

    }

?>