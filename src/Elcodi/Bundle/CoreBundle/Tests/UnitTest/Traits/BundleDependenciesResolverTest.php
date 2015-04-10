<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2015 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Bundle\CoreBundle\Tests\Functional\Traits;

use PHPUnit_Framework_TestCase;

use Elcodi\Bundle\CoreBundle\Tests\Functional\Classes\BundleDependenciesResolverAware;

/**
 * Class BundleDependenciesResolverTest
 */
class BundleDependenciesResolverTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test resolver
     */
    public function testResolver()
    {
        $bundleDependenciesResolver = new BundleDependenciesResolverAware();
        $bundles = $bundleDependenciesResolver->getBundleNamespaces();
        sort($bundles);

        $this->assertEquals(
            [
                'Elcodi\Bundle\CoreBundle\Tests\Functional\Classes\Bundle1',
                'Elcodi\Bundle\CoreBundle\Tests\Functional\Classes\Bundle2',
                'Elcodi\Bundle\CoreBundle\Tests\Functional\Classes\Bundle3',
                'Elcodi\Bundle\CoreBundle\Tests\Functional\Classes\Bundle4',
            ],
            $bundles
        );
    }
}