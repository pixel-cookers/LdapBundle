<?php

namespace Bundle\OpenSky\LdapBundle\Tests\DependencyInjection\Security\Factory;

use Bundle\OpenSky\LdapBundle\DependencyInjection\Security\Factory\HttpBasicPreAuthenticatedFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class HttpBasicPreAuthenticatedFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $factory = new HttpBasicPreAuthenticatedFactory();
        $container = new ContainerBuilder();
        $userProvider = $this->getMock('Symfony\Component\Security\User\UserProviderInterface');
        $defaultEntryPoint = $this->getMock('Symfony\Component\Security\Authentication\EntryPoint\AuthenticationEntryPointInterface');

        $container->setDefinition('security.authentication.listener.basic_pre_auth', new Definition());

        list($provider, $listenerId, $returnedDefaultEntryPoint) = $factory->create($container, rand(), array(), $userProvider, $defaultEntryPoint);

        $this->assertTrue($container->hasDefinition($provider));
        $this->assertTrue($container->hasDefinition($listenerId));
        $this->assertSame($defaultEntryPoint, $returnedDefaultEntryPoint);
    }
}
