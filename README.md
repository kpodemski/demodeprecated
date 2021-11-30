## Demo of "How to handle deprecated methods between versions"

## About

This module demonstrates how you can handle deprecated code between a few versions of the PrestaShop software.

If you need to support multiple versions of the PrestaShop in the single package of your module, this example is for you.

### Usecase

This module will print on screen (using `displayHome` hook) a price using 2 different currencies.
The service responsible for currency format has changed between PS 1.7 and PS 8.0. This module demonstrates how to deal with this technical challenge to achieve a module that you can run from PS 1.6 to PS 8.0

 ### Supported PrestaShop versions

 This module has been tested with PrestaShop 1.6.1.0 and above versions.

 ### Requirements

  1. Composer, see [Composer](https://getcomposer.org/) to learn more

 ### How to install

  1. Download or clone module into `modules` directory of your PrestaShop installation
  2. Rename the directory to make sure that module directory is named `demodeprecated`*
  3. `cd` into module's directory and run following commands:
      - `composer install` - to download dependencies into vendor folder
  4. Install module from Back Office
  5. See the result on the homepage of your store

 *Because the name of the directory and the name of the main module file must match.
