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

use Nucleos\UserAdminBundle\Twig\GlobalVariables;

return static function (ContainerConfigurator $container): void {
    $container->services()

        ->set('nucleos_user_admin.twig.global', GlobalVariables::class)
            ->args([
                service('nucleos_user_admin.admin.user')->ignoreOnInvalid(),
            ])

    ;
};
