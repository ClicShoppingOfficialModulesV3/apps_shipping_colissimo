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

  class colissimor5_national extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:12.35, 1:13.60, 2:14.55, 3:15.50, 5:17.40, 7:19.30, 10:22.15, 15:24.25, 30:30.55';
    public ?int $sort_order = 1050;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor5_national_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor5_national_desc');
    }
  }
