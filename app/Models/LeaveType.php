<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LeaveType extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public static function getAll () {
        return self::where('is_deleted', '0')->get();
    }

    public static function createInfo ($data) {
        $user = Auth::user();
        $data['created_by'] = $user->name;
        return self::insert($data);
    }

    public static function updateInfo ($data) {
        $user = Auth::user();
        $data['updated_by'] = $user->name;
        return self::where('id', $data['id'])->update($data);
    }

    public static function deleteInfo ($id) {
        $user = Auth::user();
        $data['updated_by'] = $user->name;
        $data['is_deleted'] = 1;
        return self::where('id', $id)->update($data);
    }
}
