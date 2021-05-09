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

  class colissimor4_dom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:14.05, 1:18.30, 2:22.95, 3:27.60, 4:32.25, 5:36.90, 6:41.55, 7:46.20, 8:50.85, 9:55.50, 10:60.15, 15:83.35, 20:106.55, 25:129.75, 30:152.95';
    public $sort_order = 1110;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor4_dom_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor4_dom_desc');
    }
  }
