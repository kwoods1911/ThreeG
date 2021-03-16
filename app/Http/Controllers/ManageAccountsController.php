<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ManageAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //KW display a list of all accounts
        $accounts = User::all();//KW returning all user accounts to index
        return view('manageaccounts.index')->with('accounts',$accounts); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manageaccounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'confirm_email' => 'required',
            'password'=> 'required',
            'confirm_password' => 'required',
            'user_role' => 'required'
        ]);

        //KW store request in variables
        $name = $request->input('name');
        $email = $request->input('email');
        $confirm_email = $request->input('confirm_email');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $user_role = $request->input('user_role');


        //KW test that the emails match and that the password match. 
        if($email !== $confirm_email){//KW emails do not match
            return redirect('/manageaccounts/create')->with('error', 'Error emails do not match.');
        }elseif($password !== $confirm_password){//KW password do not match
            return redirect('/manageaccounts/create')->with('error', 'Error password do not match.');
        }else{
            //KW everyone matches create account
            $account = new User;
            $account->name = $name;
            $account->email = $email;
            $account->password =Hash::make($password);
            $account->user_role = $user_role;
            $account->save();
            return redirect('/manageaccounts/create')->with('success', 'Account created!');
        }
        
        
        //KW present appropriate error message if error occurs.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('manageaccounts.show')->with('account',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('manageaccounts.edit')->with('account',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'confirm_email' => 'required',
            'password'=> 'required',
            'confirm_password' => 'required',
            'user_role' => 'required'
        ]);

                //KW store request in variables
                $name = $request->input('name');
                $email = $request->input('email');
                $confirm_email = $request->input('confirm_email');
                $password = $request->input('password');
                $confirm_password = $request->input('confirm_password');
                $user_role = $request->input('user_role');
        
        
                //KW test that the emails match and that the password match. 
                if($email !== $confirm_email){//KW emails do not match
                    return redirect('/manageaccounts/create')->with('error', 'Error emails do not match.');
                }elseif($password !== $confirm_password){//KW password do not match
                    return redirect('/manageaccounts/create')->with('error', 'Error password do not match.');
                }else{
                    //KW everyone matches create account
                    $account = User::find($id);
                    $account->name = $name;
                    $account->email = $email;
                    $account->password = Hash::make($password);
                    $account->user_role = $user_role;
                    $account->save();
                    return redirect("/manageaccounts")->with('success', 'Account Updated!');
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //KW confirm that you want to delete the user account before actually deleting the account.

    $user = User::find($id);
    $user->delete();
    return redirect('/manageaccounts')->with('success','Account Deleted');
    }
}
