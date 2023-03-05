<?php

namespace App\Http\Controllers;

use Livewire\Component;
use App\Models\User;
use WireUi\Traits\Actions;
use Auth;
class Users extends Component
{
    use Actions;
    public $search,$simpleModal,$title="Add New User",$update,$name,$email,$password,$routes=[];
    public function save(){
        $emailVal = $this->update ? "required|unique:users,email,".$this->update : "required|unique:users,email";
        $passwordVal = $this->update ? "nullable" : "required";
        $this->validate([
            'name'=>'required',
            'email'=>$emailVal,
            'password'=>$passwordVal,
        ]);
        User::updateOrCreate([
            'id'=>$this->update,
        ],[
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password ? bcrypt($this->password) : User::find($this->update)->password,
            'routes' => array_keys(array_filter($this->routes)),
            'email_verified_at' => now(),
        ]);
        $this->reset();
        $this->notification()->success(
            $title = $this->update ? $this->name . " Updated !" : "User Added",
            $description = $this->update ? $this->name." Was Successfull Updated" : 'Your User was successfull saved'
        );
    }

    public function lock(User $user){
        $user->update([
            'lock' => $user->lock ? null : 1
        ]);
        $this->notification()->success(
            $title = "Change Lock Status",
            $description = "User has been Change Lock Status"
        );
    }
    public function edit(User $user){
        $this->update = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->routes = array_fill_keys($user->routes, true);
        $this->title = "Edit User";
        $this->simpleModal = true;
    }
    public function render()
    {
        $array =[
            'users' => User::ofSearch($this->search)->where('id','<>',Auth::id())->latest()->get(),
            'all_routes' => [
                "home",
                "sell",
                "colors",
                "companies",
                "suppliers",
                "settings",
                "users",
                "invoices",
                "devices",
                "countries",
                "sales",
                "refunds",
            ]
        ];
        return view('users',$array)->extends('layouts.app');
    }
}
