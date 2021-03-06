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

namespace Elcodi\Component\Cart\Wrapper;

use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;
use Elcodi\Component\Cart\Repository\CartRepository;
use Elcodi\Component\Cart\Services\CartSessionManager;
use Elcodi\Component\Core\Wrapper\Interfaces\WrapperInterface;

/**
 * Class CartSessionWrapper
 */
class CartSessionWrapper implements WrapperInterface
{
    /**
     * @var CartSessionManager
     *
     * CartSessionManager
     */
    protected $cartSessionManager;

    /**
     * @var CartRepository
     *
     * Cart repository
     */
    protected $cartRepository;

    /**
     * @var CartInterface
     *
     * Cart loaded
     */
    protected $cart;

    /**
     * Construct method
     *
     * @param CartSessionManager $cartSessionManager CartSessionManager
     * @param CartRepository     $cartRepository     Cart Repository
     */
    public function __construct(
        CartSessionManager $cartSessionManager,
        CartRepository $cartRepository
    ) {
        $this->cartSessionManager = $cartSessionManager;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Get loaded object. If object is not loaded yet, then load it and save it
     * locally. Otherwise, just return the pre-loaded object
     *
     * @return CartInterface|null Loaded object
     */
    public function get()
    {
        if ($this->cart instanceof CartInterface) {
            return $this->cart;
        }

        $this->cart = $this->loadCartFromSession();

        return $this->cart;
    }

    /**
     * Clean loaded object in order to reload it again.
     *
     * @return $this Self object
     */
    public function clean()
    {
        $this->cart = null;

        return $this;
    }

    /**
     * Get cart from session
     *
     * @return CartInterface|null Cart loaded from session
     */
    protected function loadCartFromSession()
    {
        $cartIdInSession = $this
            ->cartSessionManager
            ->get();

        if (!$cartIdInSession) {
            return null;
        }

        return $this
            ->cartRepository
            ->findOneBy([
                'id'      => $cartIdInSession,
                'ordered' => false,
            ]);
    }
}
