<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VehicleRecord extends Model
{
    protected $fillable = [
        'vehicle_no',
        'customer_id',
        'sale_type_id',
        'date_of_install',
        'last_pay_date',
        'last_pay_amount',
        'renewal_date',
        'renewal_amount',
        'duration',
        'agreed_rate',
        'device_model',
        'device_imei',
        'sim_no',
        'sales_person',
        'remarks'
    ];

    public function setDateOfInstallAttribute($value)
    {
        $date = strtr($value, '/', '-');
        $this->attributes['date_of_install'] = date("Y-m-d", strtotime($value));
    }

    public function setLastPayDateAttribute($value)
    {
        $date = strtr($value, '/', '-');
        $this->attributes['last_pay_date'] = date("Y-m-d", strtotime($value));
    }

    public function setRenewalDateAttribute($value)
    {
        $date = strtr($value, '/', '-');
        $this->attributes['renewal_date'] = date("Y-m-d", strtotime($value));
    }

    public function getDateOfInstallAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    public function getLastPayDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getRenewalDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function salesType()
    {
        return $this->belongsTo('App\SaleType', 'sale_type_id');
    }

    public function scopeFilter($query, $params)
    {
        if ( isset($params['customer_id']) && trim($params['customer_id']) !== '' )
        {
            $query->where('customer_id', '=', trim($params['customer_id']));
        }

        if ( isset($params['last_pay_amount']) && trim($params['last_pay_amount']) !== '' )
        {
            $query->where('last_pay_amount', '=', trim($params['last_pay_amount']));
        }

        if ( isset($params['from']) && trim($params['from']) !== '' && isset($params['to']) && trim($params['to']) !== '' )
        {
            $start_date = date("Y-m-d", strtotime(Str::before($params['from'], trim('-'))));
            $end_date = date("Y-m-d", strtotime(Str::after($params['to'], trim('-'))));
            $query->whereBetween('renewal_date', [$start_date, $end_date]);
        }

        if ( isset($params['sale_from']) && trim($params['sale_from']) !== '' && isset($params['sale_to']) && trim($params['sale_to']) !== '' )
        {
            $start_date = date("Y-m-d", strtotime(Str::before($params['sale_from'], trim('-'))));
            $end_date = date("Y-m-d", strtotime(Str::after($params['sale_to'], trim('-'))));
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        if ( isset($params['last_pay_date']) && trim($params['last_pay_date']) !== '')
        {
            $start_date = date("Y-m-d", strtotime(Str::before($params['last_pay_date'], trim('-'))));
            $end_date = date("Y-m-d", strtotime(Str::after($params['last_pay_date'], trim('-'))));
            $query->whereBetween('last_pay_date', [$start_date, $end_date]);
        }
        return $query;
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
