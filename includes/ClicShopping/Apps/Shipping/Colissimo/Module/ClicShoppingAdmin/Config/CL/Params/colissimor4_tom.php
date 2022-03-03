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

  class colissimor4_tom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:15.70, 1:20.80, 2:32.40, 3:44.00, 4:55.60, 5:67.20, 6:78.80, 7:90.40, 8:102.00, 9:113.60, 10:125.20, 15:183.20, 20:241.20, 25:299.20, 30:357.20';
    public ?int $sort_order = 1180;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor4_tom_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor4_tom_desc');
    }
  }
