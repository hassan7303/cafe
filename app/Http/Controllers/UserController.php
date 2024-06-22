<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $prefix = '10';
    public function show(Request $requesr)
    {
        return $requesr->id ? User::find($requesr->id) : User::all();
    }
    public function insert(UserRequest $requesr)
    {
        if (!$requesr->code) {
            return Helpers::sendSMS($requesr->phone);
        }
        $result = Helpers::vereFaySMS($requesr->phone, $requesr->code);
        if ($result['status'] === false) {
            return $result['snackbar']['message'];
        }
        try {
            $informations = User::firstOrCreate(['phone' => '0' . substr($requesr->phone, -10)]);
            return Helpers::successRequest($informations);
        } catch (\Exception $e) {
            return Helpers::error('db conection error', $this->prefix . __LINE__);
        }
    }

    public function updated(Request $requesr)
    {
        if ($requesr->phone) {
            try {
                User::where('phone', $requesr->phone)->update([
                    'firstname' => $requesr->firstname,
                    'lastname' => $requesr->firstname,
                    'is_admin' => 1
                ]);
                return Helpers::successRequest(null, 'update user is success');
            } catch (\Exception $e) {
                return Helpers::error('db conection error', $this->prefix . __LINE__);
            }
        }
        return Helpers::error('The phone number is not available', $this->prefix . __LINE__);
    }
    public function delete(Request $requesr)
    {
        if ($requesr->phone) {
            User::where($requesr->phone)->delete();
        }
        return Helpers::error('The phone number is not available', $this->prefix . __LINE__);
    }
}
