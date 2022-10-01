<?php

    namespace BlakeJones\MagicForms\Components;

    use BlakeJones\MagicForms\Classes\MagicForm;

    class GenericForm extends MagicForm {

        public function componentDetails() {
            return [
                'name'        => 'blakejones.magicforms::lang.components.generic_form.name',
                'description' => 'blakejones.magicforms::lang.components.generic_form.description',
            ];
        }

    }

?>