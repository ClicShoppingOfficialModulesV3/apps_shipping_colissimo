<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @licence MIT - Portion of osCommerce 2.4
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\CL\Params;

  class colissimor1_tom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:12.40, 1:17.50, 2:29.10, 3:40.70, 4:52.30, 5:63.90, 6:75.50, 7:87.10, 8:98.70, 9:110.30, 10:121.90, 15:179.90, 20:237.90, 25:295.90, 30:353.90';
    public $sort_order = 1150;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor1_tom_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor1_tom_desc');
    }
  }
