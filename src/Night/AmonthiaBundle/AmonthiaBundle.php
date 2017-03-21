<?php

namespace Night\AmonthiaBundle;

use Night\AmonthiaBundle\DependencyInjection\ApiCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AmonthiaBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ApiCompilerPass());
    }
}
