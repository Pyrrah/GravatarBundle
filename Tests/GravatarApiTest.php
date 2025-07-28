<?php

namespace Pyrrah\GravatarBundle\Tests;

use Pyrrah\GravatarBundle\GravatarApi;
use PHPUnit\Framework\TestCase;

class GravatarApiTest extends TestCase
{
    public function testGravatarUrlWithDefaultOptions()
    {
        $api = new GravatarApi();
        $this->assertEquals('https://secure.gravatar.com/avatar/0aa61df8e35327ac3b3bc666525e0bee?s=80&r=g', $api->getUrl('henrik@bearwoods.dk   '));
    }

    public function testGravatarUrlWithDefaultImage()
    {
        $api = new GravatarApi();
        $this->assertEquals('https://secure.gravatar.com/avatar/0aa61df8e35327ac3b3bc666525e0bee?s=80&r=g&d=mm', $api->getUrl('henrik@bearwoods.dk', 80, 'g', 'mm', 'url'));
    }

    public function testGravatarProfileUrlWithDefaultImage()
    {
        $api = new GravatarApi();
        $this->assertEquals('https://secure.gravatar.com/0aa61df8e35327ac3b3bc666525e0bee', $api->getProfileUrl('henrik@bearwoods.dk'));
    }

    public function testGravatarInitializedWithOptions()
    {
        $api = new GravatarApi(array(
            'size'    => 20,
            'default' => 'mm',
            'rating'  => 'g',
            'format'  => 'url',
        ));

        $this->assertEquals('https://secure.gravatar.com/avatar/0aa61df8e35327ac3b3bc666525e0bee?s=20&r=g&d=mm', $api->getUrl('henrik@bearwoods.dk'));
    }

    public function testGravatarExists()
    {
        $api = new GravatarApi();

        $this->assertFalse($api->exists('somefake@email.com'));

        $this->assertTrue($api->exists('henrik@bjrnskov.dk'));
    }
}
