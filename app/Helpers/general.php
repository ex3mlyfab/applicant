<?php

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\DB;

if (!function_exists('startsWith')) {
    function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}
if (!function_exists('sql_escape')) {
    function sql_escape($unsafe_str)
    {
        if (get_magic_quotes_gpc()) {
            $unsafe_str = stripslashes($unsafe_str);
        }
        return $escaped_str = str_replace("'", "", $unsafe_str);
    }
}
if (!function_exists('get_charge_amount')) {
    function get_charge_amount($id)
    {
        $class = DB::table('charges')->where('id', $id)->get();
        if (!$class->isEmpty()) {
            return $class[0]->amount;
        }
        return "";
    }
}
if (!function_exists('generate_invoice_no')) {
    function generate_invoice_no()
    {
        $invoice = new Invoice();
        $number = $invoice->whereYear('created_at', '=', date('Y'))->count();
        $number += 1;
        $formatted_value = sprintf("%04d", $number);

        return $formatted_value . "/" . date('Y');
    }
}
if (!function_exists('assign_Fno')) {
    function assign_Fno()
    {
        $users = new User();
        $count = $users->whereYear('created_at', '=', date('Y'))
            ->count();
        $count += 1;
        $formatted_value = sprintf("%04d", $count);

        return $formatted_value . "/" . date('Y');
    }
}

if (!function_exists('num_to_letters')) {
    function num_to_letters($num, $uppercase = true)
    {
        $letters = '';
        while ($num > 0) {
            $code = ($num % 26 == 0) ? 26 : $num % 26;
            $letters .= chr($code + 64);
            $num = ($num - $code) / 26;
        }
        return ($uppercase) ? strtoupper(strrev($letters)) : strrev($letters);
    }
}

if (!function_exists('create_option')) {
    function create_option($table, $value, $display, $selected = "", $where = NULL)
    {
        $options = "";
        $condition = "";
        if ($where != NULL) {
            $condition .= "WHERE ";
            foreach ($where as $key => $v) {
                $condition .= $key . "'" . $v . "' ";
            }
        }

        $query = DB::select("SELECT $value, $display FROM $table $condition");
        foreach ($query as $d) {
            if ($selected != "" && $selected == $d->$value) {
                $options .= "<option value='" . $d->$value . "' selected='true'>" . ucwords($d->$display) . "</option>";
            } else {
                $options .= "<option value='" . $d->$value . "'>" . ucwords($d->$display) . "</option>";
            }
        }

        echo $options;
    }
}

if (!function_exists('get_table')) {
    function get_table($table, $where = NULL)
    {
        $condition = "";
        if ($where != NULL) {
            $condition .= "WHERE ";
            foreach ($where as $key => $v) {
                $condition .= $key . "'" . $v . "' ";
            }
        }
        $query = DB::select("SELECT * FROM $table $condition");
        return $query;
    }
}
if (!function_exists('user_count')) {
    function user_count($user_type)
    {
        $count = \App\Models\User::where("user_type", $user_type)
            ->selectRaw("COUNT(id) as total")
            ->first()->total;
        return $count;
    }
}
if (!function_exists('get_logo')) {
    function get_logo()
    {
        $logo = get_option("logo");
        if ($logo == "") {
            return asset("public/uploads/logo.png");
        }
        return asset("public/uploads/$logo");
    }
}
if (!function_exists('get_option')) {
    function get_option($name)
    {
        $setting = DB::table('settings')->where('name', $name)->get();
        if (!$setting->isEmpty()) {
            return $setting[0]->value;
        }
        return "";
    }
}

if (!function_exists('has_permission')) {
    function has_permission($name, $role_id)
    {
        $permission = DB::table('permissions')
            ->where('permission', $name)
            ->where('role_id', $role_id)
            ->get();
        if (!$permission->isEmpty()) {
            return true;
        }
        return false;
    }
}


if (!function_exists('get_fee_select')) {

    function get_fee_selectbox($class = "", $fee_id = "")
    {
        $select = "<select name='fee_type[]' class='form-control $class'>";
        $select .= "<option value=''>" . 'Select One' . "</option>";

        foreach (get_table("fees") as $fee_type) {
            $selected = $fee_id == $fee_type->id ? "selected" : "";
            $select .= "<option value='" . $fee_type->id . "' $selected>" . $fee_type->fee_type . "</option>";
        }
        $select .= "</select>";
        return $select;
    }
}




if (!function_exists('object_to_string')) {
    function object_to_string($object, $col, $quote = false)
    {
        $string = "";
        foreach ($object as $data) {
            if ($quote == true) {
                $string .= "'" . $data->$col . "', ";
            } else {
                $string .= $data->$col . ", ";
            }
        }
        $string = substr_replace($string, "", -2);
        return $string;
    }
}
