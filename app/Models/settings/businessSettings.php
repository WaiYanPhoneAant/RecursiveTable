<?php

namespace App\Models\settings;

use App\Models\BusinessUser;
use App\Models\Currencies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class businessSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'currency_id',
        'secondary_currency_id',
        'lot_control',
        'start_date',
        'default_profit_percent',
        'currency_decimal_places',
        'quantity_decimal_places',
        'currency_symbol_placement',
        'finanical_year_start_month',
        'owner_id',
        'time_zone',
        'fy_start_month',
        'accounting_method',
        'use_paymentAccount',
        'default_sales_discount',
        'sell_price_tax',
        'logo',
        'sku_prefix',
        'business_location_prefix',
        'enable_product_expiry',
        'expiry_type',
        'on_product_expiry',
        'stop_selling_before',
        'enable_tooltip',
        'enable_line_discount_for_purchase',
        'enable_line_discount_for_sale',
        'purchase_in_diff_currency',
        'purchase_currency_id',
        'p_exchange_rate',
        'transaction_edit_days',
        'stock_expiry_alert_days',
        'keyboard_shortcuts',
        'pos_settings',
        'essentials_settings',
        'weighing_scale_setting',
        'enable_brand',
        'enable_category',
        'enable_sub_category',
        'enable_price_tax',
        'enable_purchase_status',
        'enable_lot_number',
        'default_unit',
        'enable_sub_units',
        'enable_racks',
        'enable_row',
        'enable_position',
        'enable_editing_product_from_purchase',
        'sales_cmsn_agnt',
        'item_addition_method',
        'enable_inline_tax',
        'currency_symbol_placement',
        'enabled_modules',
        'date_format',
        'time_format',
        'ref_no_prefixes',
        'theme_color',
        'created_by',
        'repair_settings',
        'enable_rp',
        'rp_name',
        'amount_for_unit_rp',
        'min_order_total_for_rp',
        'max_rp_per_order',
        'redeem_amount_per_unit_rp',
        'min_order_total_for_redeem',
        'min_redeem_point',
        'max_redeem_point',
        'rp_expiry_period',
        'rp_expiry_type',
        'email_settings',
        'sms_settings',
        'custom_labels',
        'common_settings',
        'is_active',
        'allow_overselling',
        'variable_cost',



        // prefix
        'sale_prefix',
        'purchase_prefix',
        'stock_transfer_prefix',
        'stock_adjustment_prefix',
        'expense_prefix',
        'purchase_payment_prefix',
        'expense_payment_prefix',
        'sale_payment_prefix',
        'expense_report_prefix',
        'enable_payment_confirmation_in_sale',

        'prefixs',

        //
        'invoice_layout',

        'alt_contact_no',
        'business_contact_no',
        'address',
        'zip_postal_code',
        'city',
        'state',
        'country',
        'expire_alert_day',
        'sales_print_preview',
        'use_print_preview',
        'variable_cost'
    ];

    protected $casts = [
        'prefixs' => 'json',
    ];
    public function currency(){
        return $this->hasOne(Currencies::class,'id','currency_id');
    }
    public function owner()
    {
        return $this->hasOne(BusinessUser::class, 'id', 'owner_id');
    }

    public function createPrefix()
    {
        $this->update([
            'prefixs'=>[
                'sale_prefix' => self::defaultPrefix('SL'), // Call statically
                'purchase_prefix' => self::defaultPrefix('PC'),
                'stock_transfer_prefix' => self::defaultPrefix('ST'),
                'stock_adjustment_prefix' => self::defaultPrefix('SA'),
                'expense_prefix' => self::defaultPrefix('EP'),
                'purchase_payment_prefix' => self::defaultPrefix('PCP'),
                'expense_payment_prefix' => self::defaultPrefix('EPP'),
                'sale_payment_prefix' => self::defaultPrefix('SLP'),
                'expense_report_prefix' => self::defaultPrefix('EPR'),
                'business_location_prefix' => self::defaultPrefix('LOC'),
                ]
        ]);
    }

    private static function defaultPrefix(string $name): array
    {
        return [
            'name' => $name,
            'year' => false,
            'month' => false,
            'day' => false,
            'starter_count' => 1,
            'digit' => 5,
            'is_continue' => true,
        ];
    }
}
