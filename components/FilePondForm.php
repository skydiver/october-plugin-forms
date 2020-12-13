<?php

namespace Martin\Forms\Components;

use Lang;
use October\Rain\Filesystem\Definitions;
use Martin\Forms\Classes\MagicForm;

class FilePondForm extends MagicForm
{
    public function componentDetails()
    {
        return [
            'name'        => 'martin.forms::lang.components.filepond_form.name',
            'description' => 'martin.forms::lang.components.filepond_form.description',
        ];
    }

    public function defineProperties()
    {
        $local = [
            'uploader_enable' => [
                'title'             => 'martin.forms::lang.components.shared.uploader_enable.title',
                'description'       => 'martin.forms::lang.components.shared.uploader_enable.description',
                'default'           => false,
                'type'              => 'checkbox',
                'group'             => 'martin.forms::lang.components.shared.group_uploader',
                'showExternalParam' => false,
            ],
            // 'mail_uploads' => [
            //     'title'             => 'martin.forms::lang.components.shared.mail_uploads.title',
            //     'description'       => 'martin.forms::lang.components.shared.mail_uploads.description',
            //     'type'              => 'checkbox',
            //     'default'           => false,
            //     'group'             => 'martin.forms::lang.components.shared.group_mail',
            //     'showExternalParam' => false
            // ],
            // 'maxSize' => [
            //     'title'             => 'martin.forms::lang.components.shared.uploader_maxsize.title',
            //     'description'       => 'martin.forms::lang.components.shared.uploader_maxsize.description',
            //     'default'           => '5',
            //     'type'              => 'string',
            //     'group'             => 'martin.forms::lang.components.shared.group_uploader',
            //     'showExternalParam' => false,
            // ],
            // 'fileTypes' => [
            //     'title'             => 'martin.forms::lang.components.shared.uploader_types.title',
            //     'description'       => 'martin.forms::lang.components.shared.uploader_types.description',
            //     'default'           => Definitions::get('defaultExtensions'),
            //     'type'              => 'stringList',
            //     'group'             => 'martin.forms::lang.components.shared.group_uploader',
            //     'showExternalParam' => false,
            // ],
        ];
        return array_merge(parent::defineProperties(), $local);
    }
}
