<?php

/*
 * This file is part of the NucleosUserAdminBundle package.
 *
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->parameters()

        ->set('nucleos_user_admin.admin.groupname', 'user')
        ->set('nucleos_user_admin.admin.label_catalogue', 'NucleosUserAdminBundle')
        ->set('nucleos_user_admin.admin.groupicon', '<i class=\'fa fa-users\'></i>')

    ;

    $container->services()

        ->set('nucleos_user_admin.admin.user', '%nucleos_user_admin.admin.user.class%')
            ->public()
            ->tag('sonata.admin', [
                'manager_type'              => 'orm',
                'model_class'               => '%nucleos_user.model.user.class%',
                'controller'                => '%nucleos_user_admin.admin.user.controller%',
                'group'                     => '%nucleos_user_admin.admin.groupname%',
                'label'                     => 'users',
                'label_catalogue'           => '%nucleos_user_admin.admin.label_catalogue%',
                'label_translator_strategy' => 'sonata.admin.label.strategy.underscore',
                'icon'                      => '%nucleos_user_admin.admin.groupicon%',
            ])
            ->args([
                service('nucleos_user.user_manager'),
            ])
            ->call('setTranslationDomain', [
                '%nucleos_user_admin.admin.group.translation_domain%',
            ])

        ->set('nucleos_user_admin.admin.group', '%nucleos_user_admin.admin.group.class%')
            ->public()
            ->tag('sonata.admin', [
                'manager_type'              => 'orm',
                'model_class'               => '%nucleos_user.model.group.class%',
                'controller'                => '%nucleos_user_admin.admin.group.controller%',
                'group'                     => '%nucleos_user_admin.admin.groupname%',
                'label'                     => 'groups',
                'label_catalogue'           => '%nucleos_user_admin.admin.label_catalogue%',
                'label_translator_strategy' => 'sonata.admin.label.strategy.underscore',
                'icon'                      => '%nucleos_user_admin.admin.groupicon%',
            ])
            ->args([
                service('nucleos_user.group_manager'),
            ])
            ->call('setTranslationDomain', [
                '%nucleos_user_admin.admin.group.translation_domain%',
            ])

    ;
};
