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

namespace Nucleos\UserAdminBundle\Action;

use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Templating\TemplateRegistryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Twig\Environment;

final class RequestAction
{
    private Environment $twig;

    private UrlGeneratorInterface $urlGenerator;

    private AuthorizationCheckerInterface $authorizationChecker;

    private Pool $adminPool;

    private TemplateRegistryInterface $templateRegistry;

    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        AuthorizationCheckerInterface $authorizationChecker,
        Pool $adminPool,
        TemplateRegistryInterface $templateRegistry
    ) {
        $this->twig                 = $twig;
        $this->urlGenerator         = $urlGenerator;
        $this->authorizationChecker = $authorizationChecker;
        $this->adminPool            = $adminPool;
        $this->templateRegistry     = $templateRegistry;
    }

    public function __invoke(Request $request): Response
    {
        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return new RedirectResponse($this->urlGenerator->generate('sonata_admin_dashboard'));
        }

        return new Response(
            $this->twig->render(
                '@NucleosUserAdmin/Admin/Security/Resetting/request.html.twig',
                [
                    'base_template' => $this->templateRegistry->getTemplate('layout'),
                    'admin_pool'    => $this->adminPool,
                ]
            )
        );
    }
}
