<?php
  /**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT
 *  @licence MIT - Portion of osCommerce 2.4
 *  @Info : https://www.clicshopping.org/forum/trademark/
 *
 */

  namespace ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\CL\Params;

  class int_countries_2 extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract {
    public $default = 'AL, DZ, BY, BA, BG, HR, CZ';
    public $sort_order = 1220;

    protected function init() {
      $this->title = $this->app->getDef('cfg_colissimo_int_countries_2_title');
      $this->description = $this->app->getDef('cfg_colissimo_int_countries_2_desc');
    }
  }
