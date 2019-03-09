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

  class colissimor3_national extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract {
    public $default = '0.500:9.95, 1:11.20, 2:12.15, 3:13.10, 5:15.00, 7:16.90, 10:19.75, 15:21.85, 30:28.15';
    public $sort_order = 1030;

    protected function init() {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor3_national_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor3_national_desc');
    }
  }
