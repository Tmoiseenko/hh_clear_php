<?php
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

try {
    $user = User::where('login', '=', 'admin')->firstOrFail();
    echo $user->role->name;

} catch (ModelNotFoundException $e) {
    var_dump($e->getMessage());
}


