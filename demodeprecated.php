<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
}

class DemoDeprecated extends Module
{

    /**
     * @var \PrestaShop\ModuleLibServiceContainer\DependencyInjection\ServiceContainer
     */
    private $serviceContainer;

    public function __construct()
    {
        $this->name = 'demodeprecated';
        $this->author = 'Krystian Podemski';
        $this->version = '1.0.0';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = 'Demo of how to deal with a deprecated methods';
        $this->description = 'Module created for the purpose of showing an example of handling a few versions of the PrestaShop in one package';
        $this->ps_versions_compliancy = array('min' => '1.6.1.0', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayHome')
            && $this->registerHook('displayHeader');
    }

    /**
     * @param string $serviceName
     *
     * @return object|null
     */
    public function getService($serviceName)
    {
        if ($this->serviceContainer === null) {
            $this->serviceContainer = new \PrestaShop\ModuleLibServiceContainer\DependencyInjection\ServiceContainer(
                $this->name . str_replace('.', '', $this->version),
                $this->getLocalPath()
            );
        }

        return $this->serviceContainer->getService($serviceName);
    }

    public function hookDisplayHome()
    {
        $priceFormatter = $this->getService('demodeprecated.module.adapter.price_formatter');

        echo '<pre>';
        print_r($priceFormatter->format(12.34)).PHP_EOL;

        $secondCurrency = new Currency(2);
        if (Validate::isLoadedObject($secondCurrency)) {
            print_r('Different currency:').PHP_EOL;
            print_r(
                $priceFormatter
                    ->setCurrency($secondCurrency)
                    ->format(12.34)
            );
        }
        
        echo '</pre>';
    }
}
