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

  namespace ClicShopping\Apps\Shipping\Colissimo\Module\Shipping;

  use ClicShopping\OM\HTML;
  use ClicShopping\OM\Registry;

  use ClicShopping\Apps\Shipping\Colissimo\Colissimo as ColissimoApp;
  use ClicShopping\Sites\Common\B2BCommon;

  class CL implements \ClicShopping\OM\Modules\ShippingInterface
  {
    public $code;
    public $title;
    public $description;
    public $enabled = false;
    public $icon;
    public $app;
    public $quotes;
    public $signature;
    public $public_title;
    public $api_version;
    public $sort_order = 0;
    public $num_international;
    public $tax_class;
    public $group;

    public function __construct()
    {
      $CLICSHOPPING_Customer = Registry::get('Customer');

      if (Registry::exists('Order')) {
        $CLICSHOPPING_Order = Registry::get('Order');
      }

      if (!Registry::exists('Colissimo')) {
        Registry::set('Colissimo', new ColissimoApp());
      }

      $this->app = Registry::get('Colissimo');
      $this->app->loadDefinitions('Module/Shop/CL/CL');

      $this->signature = 'Colissimo|' . $this->app->getVersion() . '|1.0';
      $this->api_version = $this->app->getApiVersion();

      $this->code = 'CL';
      $this->title = $this->app->getDef('module_colissimo_title');
      $this->public_title = $this->app->getDef('module_colissimo_public_title');
      $this->sort_order = defined('CLICSHOPPING_APP_COLISSIMO_CL_SORT_ORDER') ? CLICSHOPPING_APP_COLISSIMO_CL_SORT_ORDER : 0;
      $this->num_international = 6;

// Activation module du paiement selon les groupes B2B

      if ($CLICSHOPPING_Customer->getCustomersGroupID() != 0) {
        if (B2BCommon::getShippingUnallowed($this->code)) {
          if (CLICSHOPPING_APP_COLISSIMO_CL_STATUS == 'True') {
            $this->enabled = true;
          } else {
            $this->enabled = false;
          }
        }
      } else {
        if (defined('CLICSHOPPING_APP_COLISSIMO_CL_NO_AUTHORIZE') && CLICSHOPPING_APP_COLISSIMO_CL_NO_AUTHORIZE == 'True' && $CLICSHOPPING_Customer->getCustomersGroupID() == 0) {
          if ($CLICSHOPPING_Customer->getCustomersGroupID() == 0) {
            if (CLICSHOPPING_APP_COLISSIMO_CL_STATUS == 'True') {
              $this->enabled = true;
            } else {
              $this->enabled = false;
            }
          }
        }
      }

      if (defined('CLICSHOPPING_APP_COLISSIMO_CL_TAX_CLASS')) {
        if ($CLICSHOPPING_Customer->getCustomersGroupID() != 0) {
          if (B2BCommon::getTaxUnallowed($this->code) || !$CLICSHOPPING_Customer->isLoggedOn()) {
            $this->tax_class = defined('CLICSHOPPING_APP_COLISSIMO_CL_TAX_CLASS') ? CLICSHOPPING_APP_COLISSIMO_CL_TAX_CLASS : 0;

          }
        } else {
          if (B2BCommon::getTaxUnallowed($this->code)) {
            $this->tax_class = defined('CLICSHOPPING_APP_COLISSIMO_CL_TAX_CLASS') ? CLICSHOPPING_APP_COLISSIMO_CL_TAX_CLASS : 0;
          }
        }
      }

      if (($this->enabled === true) && ((int)CLICSHOPPING_APP_COLISSIMO_CL_ZONE > 0)) {
        $check_flag = false;

        $Qcheck = $this->app->db->get('zones_to_geo_zones', 'zone_id', ['geo_zone_id' => (int)CLICSHOPPING_APP_COLISSIMO_CL_ZONE,
          'zone_country_id' => $CLICSHOPPING_Order->delivery['country']['id']
        ],
          'zone_id'
        );

        while ($Qcheck->fetch()) {
          if (($Qcheck->valueInt('zone_id') < 1) || ($Qcheck->valueInt('zone_id') === $CLICSHOPPING_Order->delivery['zone_id'])) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag === false) {
          $this->enabled = false;
        }

        if ($this->shipping_weight > 30) {
          $this->enabled = false;
        }
      }
    }

    public function quote($method = '')
    {
      $CLICSHOPPING_ShoppingCart = Registry::get('ShoppingCart');
      $CLICSHOPPING_Order = Registry::get('Order');
      $CLICSHOPPING_Tax = Registry::get('Tax');
      $CLICSHOPPING_Template = Registry::get('Template');
      $CLICSHOPPING_Shipping = Registry::get('Shipping');

      $this->shipping_weight = $CLICSHOPPING_Shipping->getShippingWeight();

      $dest_country = $CLICSHOPPING_Order->delivery['country']['iso_code_2'];

      if (empty(CLICSHOPPING_APP_COLISSIMO_CL_HANDLING) || CLICSHOPPING_APP_COLISSIMO_CL_HANDLING == 0) $handling_fees = 0;

      if (($dest_country == 'FR') OR ($dest_country == 'FX') OR ($dest_country == 'MC')) {

// Suppression de l'affichage si le poids est superieur à 30 kg
        if ($this->shipping_weight < 30) {

          $this->quotes = ['id' => $this->app->vendor . '\\' . $this->app->code . '\\' . $this->code,
            'module' => $this->app->getDef('module_shipping_colissimo_text_title') . ' NATIONAL (' . $this->shipping_weight . ' Kg)'
          ];

          $methods = [];

          if (!empty($this->icon)) $this->quotes['icon'] = HTML::image($this->icon, $this->title);
        }

        $auto = constant('CLICSHOPPING_APP_COLISSIMO_CL_R1R5');
        $total = $CLICSHOPPING_ShoppingCart->show_total();

        $cost = constant('CLICSHOPPING_APP_COLISSIMO_CL_NATIONAL');
        $cost1 = constant('CLICSHOPPING_APP_COLISSIMO_CL_COLISSIMOR1_NATIONAL');
        $cost2 = constant('CLICSHOPPING_APP_COLISSIMO_CL_COLISSIMOR2_NATIONAL');
        $cost3 = constant('CLICSHOPPING_APP_COLISSIMO_CL_COLISSIMOR3_NATIONAL');
        $cost4 = constant('CLICSHOPPING_APP_COLISSIMO_CL_COLISSIMOR4_NATIONAL');
        $cost5 = constant('CLICSHOPPING_APP_COLISSIMO_CL_COLISSIMOR5_NATIONAL');

        $table = preg_split('#[:,]#', $cost);
        $table1 = preg_split('#[:,]#', $cost1);
        $table2 = preg_split('#[:,]#', $cost2);
        $table3 = preg_split('#[:,]#', $cost3);
        $table4 = preg_split('#[:,]#', $cost4);
        $table5 = preg_split('#[:,]#', $cost5);

        $j = 0;
        $k = 0;

        for ($i = 0, $iMax = count($table); $i < $iMax; $i += 2) {

          if ($this->shipping_weight > $table[$i])
            continue;

          if (($this->shipping_weight < $table[$i]) && ($j == '0')) {
            if ($auto == 'True') {
              if (($total <= 50) && ($k == '0')) {
                $methods[] = array('id' => 'R1', 'title' => $this->app->getDef('module_shipping_colissimor1_text_title'), 'cost' => $table1[$i + 1] + $handling_fees);
                $k++;
              } elseif (($total > 50) && ($total <= 200) && ($k == '0')) {
                $methods[] = array('id' => 'R2', 'title' => $this->app->getDef('module_shipping_colissimor2_text_title'), 'cost' => $table2[$i + 1] + $handling_fees);
                $k++;
              } elseif (($total > 200) && ($total <= 400) && ($k == '0')) {
                $methods[] = array('id' => 'R3', 'title' => $this->app->getDef('module_shipping_colissimor3_text_title'), 'cost' => $table3[$i + 1] + $handling_fees);
                $k++;
              } elseif (($total > 400) && ($total <= 600) && ($k == '0')) {
                $methods[] = array('id' => 'R4', 'title' => $this->app->getDef('module_shipping_colissimor4_text_title'), 'cost' => $table4[$i + 1] + $handling_fees);
                $k++;
              } elseif (($total > 600) && ($k == '0')) {
                $methods[] = array('id' => 'R5', 'title' => $this->app->getDef('module_shipping_colissimor5_text_title'), 'cost' => $table5[$i + 1] + $handling_fees);
                $k++;
              }
            } else {
              // Apparition du choix pour le client de la methode d'expedition
              if ($method == '' || $method == 'R0') {
                $methods[] = array('id' => 'R0', 'title' => $this->app->getDef('module_shipping_colissimo_text_title'), 'cost' => $table[$i + 1] + $handling_fees);
              }
              if ($method == '' || $method == 'R1') {
                $methods[] = array('id' => 'R1', 'title' => $this->app->getDef('module_shipping_colissimor1_text_title'), 'cost' => $table1[$i + 1] + $handling_fees);
              }
              if ($method == '' || $method == 'R2') {
                $methods[] = array('id' => 'R2', 'title' => $this->app->getDef('module_shipping_colissimor2_text_title'), 'cost' => $table2[$i + 1] + $handling_fees);
              }
              if ($method == '' || $method == 'R3') {
                $methods[] = array('id' => 'R3', 'title' => $this->app->getDef('module_shipping_colissimor3_text_title'), 'cost' => $table3[$i + 1] + $handling_fees);
              }
              if ($method == '' || $method == 'R4') {
                $methods[] = array('id' => 'R4', 'title' => $this->app->getDef('module_shipping_colissimor4_text_title'), 'cost' => $table4[$i + 1] + $handling_fees);
              }
              if ($method == '' || $method == 'R5') {
                $methods[] = array('id' => 'R5', 'title' => $this->app->getDef('module_shipping_colissimor5_text_title'), 'cost' => $table5[$i + 1] + $handling_fees);
              }
              $j = '2';
            }
          }
        }


        $this->quotes['methods'] = $methods;

        return $this->quotes;

      } elseif (($dest_country == 'GP') OR ($dest_country == 'MQ') OR ($dest_country == 'GF') OR ($dest_country == 'RE') OR ($dest_country == 'YT') OR ($dest_country == 'PM')) {

        if (constant('CLICSHOPPING_APP_COLISSIMO_CL_DOM_STATUS') == 'True') {
          if ($this->shipping_weight < 30) {
            $this->quotes = ['id' => $this->code,
              'module' => $this->app->getDef('module_shipping_colissimo_text_title') . ' DOM (' . $this->shipping_weight . ' Kg)'
            ];

            $methods = [];

            if (!empty($this->icon)) $this->quotes['icon'] = HTML::image($this->icon, $this->title);
          }

          $auto = constant('CLICSHOPPING_APP_COLISSIMO_CL_R1R5');
          $total = $CLICSHOPPING_ShoppingCart->show_total();

          $cost = constant('CLICSHOPPING_APP_COLISSIMO_CL_DOM');
          $cost1 = constant('CLICSHOPPING_APP_COLISSIMO_CLR1_DOM');
          $cost2 = constant('CLICSHOPPING_APP_COLISSIMO_CLR2_DOM');
          $cost3 = constant('CLICSHOPPING_APP_COLISSIMO_CLR3_DOM');
          $cost4 = constant('CLICSHOPPING_APP_COLISSIMO_CLR4_DOM');
          $cost5 = constant('CLICSHOPPING_APP_COLISSIMO_CLR5_DOM');
//php5.3
          $table = preg_split('#[:,]#', $cost);
          $table1 = preg_split('#[:,]#', $cost1);
          $table2 = preg_split('#[:,]#', $cost2);
          $table3 = preg_split('#[:,]#', $cost3);
          $table4 = preg_split('#[:,]#', $cost4);
          $table5 = preg_split('#[:,]#', $cost5);

          $j = '0';
          $k = '0';

          for ($i = 0, $iMax = count($table); $i < $iMax; $i += 2) {

            if ($this->shipping_weight > $table[$i])
              continue;
            if (($this->shipping_weight < $table[$i]) && ($j == '0')) {
              if ($auto == 'True') {
                if (($total <= 50) && ($k == '0')) {
                  $methods[] = array('id' => 'DOMR1', 'title' => $this->app->getDef('module_shipping_colissimor1_text_title'), 'cost' => $table1[$i + 1] + $handling_fees);
                  $k++;
                } elseif (($total > 50) && ($total <= 200) && ($k == '0')) {
                  $methods[] = array('id' => 'DOMR2', 'title' => $this->app->getDef('module_shipping_colissimor2_text_title'), 'cost' => $table2[$i + 1] + $handling_fees);
                  $k++;
                } elseif (($total > 200) && ($total <= 400) && ($k == '0')) {
                  $methods[] = array('id' => 'DOMR3', 'title' => $this->app->getDef('module_shipping_colissimor3_text_title'), 'cost' => $table3[$i + 1] + $handling_fees);
                  $k++;
                } elseif (($total > 400) && ($total <= 600) && ($k == '0')) {
                  $methods[] = array('id' => 'DOMR4', 'title' => $this->app->getDef('module_shipping_colissimor4_text_title'), 'cost' => $table4[$i + 1] + $handling_fees);
                  $k++;
                } elseif (($total > 600) && ($k == '0')) {
                  $methods[] = array('id' => 'DOMR5', 'title' => $this->app->getDef('module_shipping_colissimor5_text_title'), 'cost' => $table5[$i + 1] + $handling_fees);
                  $k++;
                }
              } else {
                if ($method == '' || $method == 'DOMR0') {
                  $methods[] = array('id' => 'DOMR0', 'title' => $this->app->getDef('module_shipping_colissimor5_text_title'), 'cost' => $table[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'DOMR1') {
                  $methods[] = array('id' => 'DOMR1', 'title' => $this->app->getDef('module_shipping_colissimor1_text_title'), 'cost' => $table1[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'DOMR2') {
                  $methods[] = array('id' => 'DOMR2', 'title' => $this->app->getDef('module_shipping_colissimor2_text_title'), 'cost' => $table2[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'DOMR3') {
                  $methods[] = array('id' => 'DOMR3', 'title' => $this->app->getDef('module_shipping_colissimor3_text_title'), 'cost' => $table3[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'DOMR4') {
                  $methods[] = array('id' => 'DOMR4', 'title' => $this->app->getDef('module_shipping_colissimor4_text_title'), 'cost' => $table4[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'DOMR5') {
                  $methods[] = array('id' => 'DOMR5', 'title' => $this->app->getDef('module_shipping_colissimor5_text_title'), 'cost' => $table5[$i + 1] + $handling_fees);
                }
                $j = '2';
              }
            }
          }

          $this->quotes['methods'] = $methods;

          return $this->quotes;
        }

      } elseif (($dest_country == 'NC') OR ($dest_country == 'PF') OR ($dest_country == 'WF') OR ($dest_country == 'TF')) {

        if (constant('CLICSHOPPING_APP_COLISSIMO_CL_TOM_STATUS') == 'True') {

          if ($this->shipping_weight < 30) {
            $this->quotes = ['id' => $this->app->vendor . '\\' . $this->app->code . '\\' . $this->code,
              'module' => $this->app->getDef('module_shipping_colissimo_text_title') . ' TOM (' . $this->shipping_weight . ' Kg)'
            ];

            $methods = [];

            if (!empty($this->icon)) $this->quotes['icon'] = HTML::image($this->icon, $this->title);
          }

          $auto = constant('CLICSHOPPING_APP_COLISSIMO_CL_R1R5');
          $total = $CLICSHOPPING_ShoppingCart->show_total();

          $cost = constant('CLICSHOPPING_APP_COLISSIMO_CL_TOM');
          $cost1 = constant('CLICSHOPPING_APP_COLISSIMO_CLR1_TOM');
          $cost2 = constant('CLICSHOPPING_APP_COLISSIMO_CLR2_TOM');
          $cost3 = constant('CLICSHOPPING_APP_COLISSIMO_CLR3_TOM');
          $cost4 = constant('CLICSHOPPING_APP_COLISSIMO_CLR4_TOM');
          $cost5 = constant('CLICSHOPPING_APP_COLISSIMO_CLR5_TOM');

          $table = preg_split('#[:,]#', $cost);
          $table1 = preg_split('#[:,]#', $cost1);
          $table2 = preg_split('#[:,]#', $cost2);
          $table3 = preg_split('#[:,]#', $cost3);
          $table4 = preg_split('#[:,]#', $cost4);
          $table5 = preg_split('#[:,]#', $cost5);

          $j = '0';
          $k = '0';

          for ($i = 0, $iMax = count($table); $i < $iMax; $i += 2) {
            if ($this->shipping_weight > $table[$i])
              continue;
            if (($this->shipping_weight < $table[$i]) && ($j == 0)) {
              if ($auto == 'True') {

                if (($total <= 50) && ($k == '0')) {
                  $methods[] = array('id' => 'TOMR1', 'title' => $this->app->getDef('module_shipping_colissimor1_text_title'), 'cost' => $table1[$i + 1] + $handling_fees);
                  $k++;
                } elseif (($total > 50) && ($total <= 200) && ($k == '0')) {
                  $methods[] = array('id' => 'TOMR2', 'title' => $this->app->getDef('module_shipping_colissimor2_text_title'), 'cost' => $table2[$i + 1] + $handling_fees);
                  $k++;
                } elseif (($total > 200) && ($total <= 400) && ($k == '0')) {
                  $methods[] = array('id' => 'TOMR3', 'title' => $this->app->getDef('module_shipping_colissimor3_text_title'), 'cost' => $table3[$i + 1] + $handling_fees);
                  $k++;
                } elseif (($total > 400) && ($total <= 600) && ($k == '0')) {
                  $methods[] = array('id' => 'TOMR4', 'title' => $this->app->getDef('module_shipping_colissimor4_text_title'), 'cost' => $table4[$i + 1] + $handling_fees);
                  $k++;
                } elseif (($total > 600) && ($k == '0')) {
                  $methods[] = array('id' => 'TOMR5', 'title' => $this->app->getDef('module_shipping_colissimor5_text_title'), 'cost' => $table5[$i + 1] + $handling_fees);
                  $k++;
                }
              } else {
                if ($method == '' || $method == 'TOMR0') {
                  $methods[] = array('id' => 'TOMR0', 'title' => $this->app->getDef('module_shipping_colissimo_text_title'), 'cost' => $table[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'TOMR1') {
                  $methods[] = array('id' => 'TOMR1', 'title' => $this->app->getDef('module_shipping_colissimor1_text_title'), 'cost' => $table1[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'TOMR2') {
                  $methods[] = array('id' => 'TOMR2', 'title' => $this->app->getDef('module_shipping_colissimor2_text_title'), 'cost' => $table2[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'TOMR3') {
                  $methods[] = array('id' => 'TOMR3', 'title' => $this->app->getDef('module_shipping_colissimor3_text_title'), 'cost' => $table3[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'TOMR4') {
                  $methods[] = array('id' => 'TOMR4', 'title' => $this->app->getDef('module_shipping_colissimor4_text_title'), 'cost' => $table4[$i + 1] + $handling_fees);
                }
                if ($method == '' || $method == 'TOMR5') {
                  $methods[] = array('id' => 'TOMR5', 'title' => $this->app->getDef('module_shipping_colissimor5_text_title'), 'cost' => $table5[$i + 1] + $handling_fees);
                }
                $j = '2';
              }
            }
          }

          $this->quotes['methods'] = $methods;

          return $this->quotes;
        }

      } elseif (constant('CLICSHOPPING_APP_COLISSIMO_CL_INT_STATUS') == 'True') {
        if (is_file($CLICSHOPPING_Template->getDirectoryTemplateImages() . 'logos/shipping/' . CLICSHOPPING_APP_COLISSIMO_CL_LOGO) && !empty(CLICSHOPPING_APP_COLISSIMO_CL_LOGO)) {
          $this->icon = $CLICSHOPPING_Template->getDirectoryTemplateImages() . 'logos/shipping/' . CLICSHOPPING_APP_COLISSIMO_CL_LOGO;
          $this->icon = HTML::image($this->icon, $this->title);
        } else {
          $this->icon = '';
        }

        if (!is_null($this->icon)) $this->quotes['icon'] = '&nbsp;&nbsp;&nbsp;' . $this->icon;

        if ($this->shipping_weight < 30) {
          $this->quotes = array(
            'id' => $this->app->vendor . '\\' . $this->app->code . '\\' . $this->code,
            'module' => $this->app->getDef('module_shipping_colissimo_text_title') . ' International (' . $this->shipping_weight . ' Kg)',
            'methods' => array()
          );
          if (!empty($this->icon)) $this->quotes['icon'] = HTML::image($this->icon, $this->title);
        }

        if ($this->tax_class > 0) $this->quotes['tax'] = $CLICSHOPPING_Tax->getTaxRate($this->tax_class, $CLICSHOPPING_Order->delivery['country']['id'], $CLICSHOPPING_Order->delivery['zone_id']);

        $dest_country = $CLICSHOPPING_Order->delivery['country']['iso_code_2'];

        $dest_zone = 0;

        for ($i = 1; $i <= $this->num_international; $i++) {
          $countries_table = constant('CLICSHOPPING_APP_COLISSIMO_CL_INT_COUNTRIES_' . $i);

          $country = preg_split('#[, ]#', $countries_table);
          if (in_array($dest_country, $country)) {
            $dest_zone = $i;
            break;
          }
        }

        if ($dest_zone == 0) {
          $this->quotes['error'] = $this->app->getDef('module_shipping_colissimo_int_invalid_zone');

          return $this->quotes;
        }

        $table = preg_split('#[:,]#', constant('CLICSHOPPING_APP_COLISSIMO_CL_INT_COST_' . $dest_zone));
        $cost = -1;

        for ($i = 0, $n = count($table); $i < $n; $i += 2) {
          if ($this->shipping_weight <= $table[$i]) {
            $cost = $table[$i + 1] + $handling_fees;
            break;
          }
        }

        if ($cost == -1) {
          $this->quotes['error'] = $this->app->getDef('module_shipping_colissimo_intl_undefined_rate');

          return $this->quotes;
        }

        $this->quotes['methods'][] = array(
          'id' => $this->app->vendor . '\\' . $this->app->code . '\\' . $this->code,
          'title' => $this->app->getDef('module_shipping_colissimo_int_text_way') . ' ' . $CLICSHOPPING_Order->delivery['country']['title'],
          'cost' => $cost + $handling_fees
        );

        return $this->quotes;
      }
    }

    public function check()
    {
      return defined('CLICSHOPPING_APP_COLISSIMO_CL_STATUS') && (trim(CLICSHOPPING_APP_COLISSIMO_CL_STATUS) != '');
    }

    public function install()
    {
      $this->app->redirect('Configure&Install&module=Colissimo');
    }

    public function remove()
    {
      $this->app->redirect('Configure&Uninstall&module=Colissimo');
    }

    public function keys()
    {
      return array('CLICSHOPPING_APP_COLISSIMO_CL_SORT_ORDER');
    }
  }