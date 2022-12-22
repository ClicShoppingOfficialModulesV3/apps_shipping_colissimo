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

  class int_countries_1 extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = 'AT, AD, AX, BE, BG, BL, CH, CY, CZ, DE, DK, ES, EE, FI, GB, GF, GI, GP, GR, HU, IE, IT, LT, LU, LV, MF, MQ, MT, NL, PL, PT, RE, RO, SE, SI, SK';
    public ?int $sort_order = 1200;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_int_countries_1_title');
      $this->description = $this->app->getDef('cfg_colissimo_int_countries_1_desc');
    }
  }
