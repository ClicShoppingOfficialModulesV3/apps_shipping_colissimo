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

  class colissimor3_tom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract {
    public $default = '0.500:13.30, 1:18.40, 2:30.00, 3:41.60, 4:53.20, 5:64.80, 6:76.40, 7:88.00, 8:99.60, 9:111.20, 10:122.80, 15:180.80, 20:238.80, 25:296.80, 30:354.80';
    public $sort_order = 1170;

    protected function init() {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor3_tom_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor3_tom_desc');
    }
  }
