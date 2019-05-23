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

  class tom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:10.10, 1:15.20, 2:26.80, 3:38.40, 4:50.00, 5:61.60, 6:73.20, 7:84.80, 8:96.40, 9:108.00, 10:119.60, 15:177.60, 20:235.60, 25:293.60, 30:351.60';
    public $sort_order = 1140;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_tom_title');
      $this->description = $this->app->getDef('cfg_colissimo_tom_desc');
    }
  }
