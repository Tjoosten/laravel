<?php

namespace App\Http\Controllers;

use App\User;
use App\Jobs;
use App\Http\Requests;
use App\Http\Requests\registerValidation;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller {

  /**
   * User management view.
   *
   * @return virw
   */
  public function index() {
    $data['title'] = Lang::get('');
    $data['query'] = User::paginate(25);
    $data['jobs']  = Jobs::all();

    return view('admin.users', $data);
  }

  /**
   * Try to login the user.
   *
   * @link   POST /login/verify
   * @return Response
   */
  public function verify() {
    $requirements = [
      'email'    => Input::get('email'),
      'password' => Input::get('password'),
      'active'   => 'Y'
    ];

    if(Auth::attempt($requirements)) {
      $alert['class']   = 'alert alert-danger';
      $alert['heading'] = Lang::get('alerts.danger');
      $alert['message'] = Lang::get('authencation.errorLogin');

      return Redirect::back()->with($alert);
    } else {
      return Redirect::back()->withInput();
    }
  }

  /**
   * Get the view fot the login screen.
   *
   * @link   GET /auth/login
   * @return \Illuminate\View\View
   */
  public function viewLogin() {
    $data['title'] = Lang::get('authencation.titleLogin');

    return view('login', $data);
  }

  /**
   * Recover a lost password.
   *
   * @link   GET /user/recovery
   * @todo   Make email function.
   * @return Response
   */
  public function recover() {
    $query = User::where('email', '=', Input::get('email'))->get();

    if(! $query) {
      $alert['class']   = 'alert alert-danger';
      $alert['heading'] = Lang::get('alerts.danger');
      $alert['message'] = Lang::get('authencation.errorRecover');
    } else {
      $newPassword     = Hash::make(str_random(4));

      $MySQL           = User::where('password', '=', Input::get('email'));
      $MySQL->password = $newPassword;
      $MySQL->save();

      $alert['class']   = 'alert alert-success';
      $alert['heading'] = Lang::get('alerts.success');
      $alert['message'] = Lang::get('authencation.successRecover');
    }

    return Redirect::back()->with($alert);
  }

  /**
   * Get the view for the register form.
   *
   * @link   GET /user/register
   * @return \Illuminate\View\View
   */
  public function registerView() {
    $data['title']      = Lang::get('authencation.titleRegister');
    $data['nav_active'] = 4;

    return view('Register', $data);
  }

  /**
   * Insert the register data to the database.
   * Function will only run when the validation is ok.
   *
   * @link  POST /user/register
   * @param registerValidation $request
   * @return mixed
   */
  public function postRegister(registerValidation $request) {
    $MySQL            = new User;
    $MySQL->firstname = $request->firstname;
    $MySQL->lastname  = $request->lastname;
    $MySQL->email     = $request->email;
    $MySQL->active    = 'Y';
    $MySQL->role      = 'U';
    $MySQL->save();

    $alert['class']   = 'alert alert-success';
    $alert['heading'] = Lang::get('alerts.success');
    $alert['message'] = Lang::get('authencation.successRegister');

    return Redirect::back()->with($alert);
  }

  /**
   * Prevent a user to login
   *
   * @link       GET /user/block/{id}
   * @middleware Admin
   * @param      $id; int, the user id.
   * @return     void
   */
  public function doBlock($id) {
    $MySQL         = User::find($id);
    $MySQL->active = "N";
    $MySQL->save();

    if($MySQL->count() == 1) {
      $alert['class']   = 'alert alert-success';
      $alert['heading'] = Lang::get('alerts.success');
      $alert['message'] = Lang::get('errorDoBlock');
    } else {
      $alert['class']   = 'alert alert-danger';
      $alert['heading'] = Lang::get('alerts.danger');
      $alert['message'] = Lang::get('successDoBlock');
    }

    return Redirect::back()->with($alert);
  }

  /**
   * Enable a user to login
   *
   * @link       GET /user/unblock/{id}
   * @middleware Admin
   * @param      $id; int, the user id.
   * @return     void
   */
  public function UndoBlock($id) {
    $MySQL          = User::find($id);
    $MySQL->active  = "Y";
    $MySQL->save();

    if($MySQL->count() == 1) {
      $alert['class']   = 'alert alert-success';
      $alert['heading'] = Lang::get('alerts.success');
      $alert['message'] = Lang::get('');
    } else {
      $alert['class']   = 'alert alert-danger';
      $alert['heading'] = Lang::get('alerts.danger');
      $alert['message'] = Lang::get('authencation.error');
    }

    return Redirect::back()->with($alert);
  }

  /**
   * Set a user to administrator.
   *
   * @link       GET /user/admin/{id}
   * @middleware Admin.
   * @param      $id, int, the user id.
   * @return     void
   */
  public function DoAdmin($id) {
    $MySQL       = User::find($id);
    $MySQL->role = 'A';
    $MySQL->save();

    if($MySQL->count() == 1) {
      $alert['class']   = 'alert alert-success';
      $alert['heading'] = Lang::get('alerts.success');
      $alert['message'] = Lang::get('alerts.successDoAdmin');
    } else {
      $alert['class']   = 'alert alert-danger';
      $alert['heading'] = Lang::get('alerts.danger');
      $alert['message'] = Lang::get('alerts.errorDoAdmin');
    }

    return Redirect::back()->with($alert);
  }

  /**
   * Set a login to user
   *
   * @link       GET /user/UndoAdmin/{id}
   * @middleware Admin
   * @param      $id, int, the user id.
   * @return     response
   */
  public function UndoAdmin($id) {
    $MySQL       = User::find($id);
    $MySQL->role = 'U';
    $MySQL->save();

    if($MySQL->count() == 1) {
      $alert['class']   = 'alert alert-success';
      $alert['heading'] = Lang::get('alerts.success');
      $alert['message'] = Lang::get('authencation.SuccessUndoAdmin');
    } else {
      $alert['class']   = 'alert alert-danger';
      $alert['heading'] = Lang::get('alerts.danger');
      $alert['message'] = Lang::get('authencation.errorUndoAdmin');
    }

    return Redirect::back()->with($alert);
  }

  /**
   * Delete a user.
   *
   * @link       GET /user/delete/{id}
   * @middleware LoggedIn, Admin
   * @param      $id, integer, the user id.
   * @return     Response.
   */
  public function deleteLogin($id) {
    $MySQL = User::find($id);
    $MySQL->delete();

    if($MySQL->count() == 1) {
      $alert['class']   = 'alert alert-success';
      $alert['heading'] = Lang::get('acl.');
      $alert['message'] = Lang::get('acl.');
    } else {
      $alert['class']   = 'alert alert-danger';
      $alert['heading'] = Lang::get('');
      $alert['message'] = Lang::get('');
    }

    return Redirect::back()->with($alert);
  }

  /**
   * Log the user out of the system.
   *
   * @link   GET /auth/logout
   * @return Response
   */
  public function logout() {

    if(Auth::logout()) {
      $alert['class']   = 'alert alert-success';
      $alert['heading'] = Lang::get('alerts.success');
      $alert['message'] = Lang::get('successLogout');
    } elseif(! Auth::logout()) {
      $alert['class']   = 'alert alert-danger';
      $alert['heading'] = Lang::get('alerts.danger');
      $alert['message'] = Lang::get('errorLogout');
    }

    return Redirect::back()->with($alert);
  }
}
