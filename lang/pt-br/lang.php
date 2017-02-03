<?php

    return [
        'plugin' => [
            'name'        => 'Magic Forms',
            'description' => 'Crie formulários fácilmente com AJAX'
        ],
        'menu' => [
            'label'    => 'Formulários Mágico',
            'records'  => ['label' => 'Registros'],
            'exports'  => ['label' => 'Exportar'],
            'settings' => 'Configurar parâmetros do plug-in',
        ],
        'controllers' => [
            'records' => [
                'title'      => 'Ver registos',
                'view_title' => 'Detalhes do registro',
                'error'      => 'Registro não encontrado',
                'deleted'    => 'Registro excluído com sucesso',
                'columns'    => [
                    'id'         => 'ID do registro',
                    'group'      => 'Grupo',
                    'ip'         => 'Endereço IP',
                    'form_data'  => 'Campos armazenados',
                    'files'      => 'Arquivos anexados',
                    'created_at' => 'Criado',
                ],
            ],
            'exports' => [
                'title'                => 'Exportar registros',
                'breadcrumb'           => 'Exportar',
                'filter_section'       => '1. Filtrar registos',
                'filter_type'          => 'Exportar todos os registros',
                'filter_groups'        => 'Grupos',
                'filter_date_after'    => 'Data após',
                'filter_date_before'   => 'Data anterior',
                'options_section'      => '2. Opções extras',
                'options_metadata'     => 'Incluir metadados',
                'options_metadata_com' => 'Exportar registros com metadados (ID de registro, grupo, IP, data criação)',
                'options_deleted'      => 'Incluir registros excluídos',
            ],
        ],
        'components' => [
            'generic_form' => [
                'name'        => 'Formulário AJAX Genérico',
                'description' => 'Por padrão renderiza um formulário genérico; Substitua o componente HTML com seus campos personalizados.',
            ],
            'upload_form' => [
                'name'        => 'formulário upload AJAX [BETA]',
                'description' => 'Mostra como implementar uploads de arquivos no formulário.',
            ],
            'empty_form' => [
                'name'        => 'Formulário AJAX vazio',
                'description' => 'Crie um modelo vazio para seu formulário personalizado; Substituir o componente HTML.',
            ],
            'shared' => [
                'csrf_error'        => 'A sessão do formulário expirou! Atualize a página.',
                'recaptcha_warn'    => 'Aviso: reCAPTCHA não está configurado corretamente. Por favor, vá para Back-end> Configurações> CMS> Magic Forms e configure.',
                'group_validation'  => 'Validação de formulários',
                'group_messages'    => 'Mensagens Flash',
                'group_mail'        => 'Configurações de Notificações',
                'group_mail_resp'   => 'Configurações de Resposta Automática',
                'group_settings'    => 'Mais configurações',
                'group_security'    => 'Segurança',
                'group_recaptcha'   => 'Configurações de reCAPTCHA',
                'group_uploader'    => 'Configurações do Uploader',
                'validation_req'    => 'A propriedade é obrigatória',
                'group'             => ['title' => 'Grupo'                        , 'description' => 'Organize seus formulários com um nome de grupo personalizado. Esta opção é útil ao exportar dados.'],
                'rules'             => ['title' => 'Regras'                       , 'description' => 'Defina suas próprias regras usando a validação Laravel'],
                'rules_messages'    => ['title' => 'Mensagens de Regras'          , 'description' => 'Use suas próprias mensagens de regras usando a validação do Laravel'],
                'messages_success'  => ['title' => 'Sucesso'                      , 'description' => 'Mensagem quando o formulário é enviado com sucesso', 'default '=>' Seu formulário foi enviado com sucesso'],
                'messages_errors'   => ['title' => 'Erros'                        , 'description' => 'Mensagem quando o formulário contém erros', 'default' => 'Ocorreu um erro no envio'],
                'mail_enabled'      => ['title' => 'Enviar Notificações'          , 'description' => 'Enviar notificações por email em todos os formulários enviados'],
                'mail_subject'      => ['title' => 'Assunto'                      , 'description' => 'Substitui o assunto de email padrão'],
                'mail_recipients'   => ['title' => 'Destinatários'                , 'description' => 'Especifique destinatários de email (adicione um endereço por linha)'],
                'mail_uploads'      => ['title' => 'Enviar Uploads'               , 'description' => 'Enviar uploads como anexos'],
                'mail_resp_enabled' => ['title' => 'Enviar Resposta Automática'   , 'description' => 'Enviar um email de resposta automática para a pessoa que envia o formulário'],
                'mail_resp_field'   => ['title' => 'Campo de Email'               , 'description' => 'Campo de formulário que contém o endereço de email do destinatário da resposta automática'],
                'mail_resp_from'    => ['title' => 'Endereço do Remetente'        , 'description' => 'Endereço de email do remetente de e-mail de resposta automática (por exemplo, noreply@yourcompany.com)'],
                'mail_resp_subject' => ['title' => 'Assunto'                      , 'description' => 'Substitui assunto de e-mail padrão'],
                'reset_form'        => ['title' => 'Limpar Fomulário'             , 'description' => 'Limpar o formulário após o envio com sucesso'],
                'allowed_fields'    => ['title' => 'Campos permitidos'            , 'description' => 'Especifique quais campos devem ser filtrados e armazenados (adicione um nome de campo por linha)'],
                'recaptcha_enabled' => ['title' => 'Habiltar reCAPTCHA'           , 'description' => 'Inserir o widget reCAPTCHA no seu formulário'],
                'recaptcha_theme'   => ['title' => 'Tema'                         , 'description' => 'Cor do tema do widget', 'light'  => 'Claro' , 'dark'    => 'Escuro'],
                'recaptcha_type'    => ['title' => 'Tipo'                         , 'description' => 'O tipo de CAPTCHA para servir' , 'image'  => 'Imagem' , 'audio'   => 'Áudio'],
                'recaptcha_size'    => ['title' => 'Tamanho'                      , 'description' => 'O tamanho do widget'       , 'normal' => 'Normal', 'compact' => 'Compacto'],
                'uploader_enable'   => ['title' => 'Permitir Uploads'             , 'description' => 'Ativar o upload de arquivos. Você precisa ativar essa opção explicitamente como uma medida de segurança.'],
                'uploader_multi'    => ['title' => 'Multiplos Arquivos'           , 'description' => 'Permitir multiplos uploads de arquivos'],
                'uploader_pholder'  => ['title' => 'texto do Placeholder'         , 'description' => 'Texto a ser exibido quando nenhum arquivo é carregado', 'default' => 'Clique ou arraste os arquivos para fazer o upload'],
                'uploader_maxsize'  => ['title' => 'Limite do Tamanho do Arquivo' , 'description' => 'O tamanho máximo de arquivo que pode ser carregado em megabytes'],
                'uploader_types'    => ['title' => 'Tipos de Arquivos Permitidos' , 'description' => 'Extensões de arquivo permitido ou asterisco (*) para todos os tipos (adicionar uma extensão por linha)'],
            ]
        ],
        'settings' => [
            'section_flash_messages'  => 'Mensagens Flash',
            'global_messages_success' => ['label' => 'Mensagem de sucesso global' , 'comment' => '(Esta definição pode ser substituída a partir do componente)', 'default' => 'Seu formulário foi enviado com sucesso'],
            'global_messages_errors'  => ['label' => 'Mensagem de Erros Global'   , 'comment' => '(Esta definição pode ser substituída a partir do componente)', 'default' => 'Ocorreu um erro o envio do formulário'],
            'section_recaptcha'       => 'Configurações de reCAPTCHA',
            'recaptcha_site_key'      => 'Chave do site',
            'recaptcha_secret_key'    => 'Chave secreta',
        ],
        'permissions' => [
            'tab'             => 'Formulários Mágico',
            'access_records'  => 'Acessar dados de formulários armazenados',
            'access_exports'  => 'Acesso à exportação de dados armazenados',
            'access_settings' => 'Acesso do módulo de configuração',
        ],
        'mails' => [
            'form_notification' => ['description' => 'Notificar quando um formulário é enviado'],
            'form_autoresponse' => ['description' => 'Resposta automática quando um formulário é enviado'],
        ],
        'validation' => [
            'recaptcha_error' => 'Não é possível validar o campo reCAPTCHA'
        ],
    ];
?>
