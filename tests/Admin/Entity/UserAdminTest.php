<?php

declare(strict_types=1);

/*
 * This file is part of the NucleosUserAdminBundle package.
 *
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\UserAdminBundle\Tests\Admin\Entity;

use Nucleos\UserAdminBundle\Admin\Entity\UserAdmin;
use Nucleos\UserAdminBundle\Tests\App\Entity\User;
use Nucleos\UserBundle\Model\UserManager;
use PHPUnit\Framework\TestCase;
use Sonata\AdminBundle\Controller\CRUDController;

final class UserAdminTest extends TestCase
{
    public function testInstance(): void
    {
        $admin = new UserAdmin(
            'admin.group',
            User::class,
            CRUDController::class,
            $this->createMock(UserManager::class)
        );

        static::assertNotEmpty($admin);
    }
}
