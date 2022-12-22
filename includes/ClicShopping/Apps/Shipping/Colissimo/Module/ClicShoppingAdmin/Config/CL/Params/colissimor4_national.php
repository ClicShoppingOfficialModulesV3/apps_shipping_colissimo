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

  class colissimor4_national extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:11.15, 1:12.40, 2:13.35, 3:14.30, 5:16.20, 7:18.10, 10:20.95, 15:23.05, 30:29.35';
    public ?int $sort_order = 1040;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor4_national_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor4_national_desc');
    }
  }
