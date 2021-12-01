<?php

namespace PrestaShop\Module\DemoDeprecated\Adapter;

use Currency;
use PrestaShop\Module\DemoDeprecated\ShopContext;
use PrestaShop\Module\DemoDeprecated\VersionChecker;
use Tools;

class PriceFormatterAdapter
{
    /**
     * @var VersionChecker
     */
    private $versionChecker;

    /**
     * @var ShopContext
     */
    private $shopContext;

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(
        ShopContext $shopContext,
        VersionChecker $versionChecker) {
        $this->shopContext = $shopContext;
        $this->currency = $shopContext->getCurrency();

        $this->versionChecker = $versionChecker;
    }

    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Tools::displayPrice() is removed in v8, we need to handle old versions of PrestaShop here
     * 
     * @param float $price
     * 
     * @return string
     */
    public function format($price)
    {
        if ($this->versionChecker->is16() || $this->versionChecker->is17()) {
            return Tools::displayPrice(
                $price,
                $this->currency
            );
        }

        if ($this->versionChecker->is8()) {
            return $this->shopContext->getCurrencyLocale()->formatPrice(
                $price,
                $this->currency->iso_code
            );
        }
    }
}
