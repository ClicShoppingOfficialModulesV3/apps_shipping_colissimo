<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT

   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\CL\Params;

  class colissimor3_dom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:12.85, 1:17.10, 2:21.75, 3:26.40, 4:31.05, 5:35.70, 6:40.35, 7:45.00, 8:49.65, 9:54.30, 10:58.95, 15:82.15, 20:105.35, 25:128.55, 30:151.75';
    public ?int $sort_order = 1100;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor3_dom_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor3_dom_desc');
    }
  }
