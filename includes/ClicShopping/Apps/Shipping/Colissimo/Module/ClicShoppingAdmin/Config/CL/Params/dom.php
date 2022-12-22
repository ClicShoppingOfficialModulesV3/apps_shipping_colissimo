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

  class dom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:8.45, 1:12.70, 2:17.35, 3:22.00, 4:26.65, 5:31.30, 6:35.95, 7:40.60, 8:45.25, 9:49.90, 10:54.55, 15:77.75, 20:100.95, 25:124.15, 30:147.35';
    public ?int $sort_order = 1070;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_dom_title');
      $this->description = $this->app->getDef('cfg_colissimo_dom_desc');
    }
  }
