<?php

/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends BaseSiteController
{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        if (Config::get('zamb.registration.allowed')) {
            return $this->render('Security.signup');
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Registration is not allowed');
        }
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            return Redirect::route('Public.Login')
                ->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {
            $error = $user->errors()->all(':message');

            return Redirect::action('UsersController@create')
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function login()
    {
        if (Confide::user()) {
            return Redirect::route('Admin.Users.Index');
        } else {
            $params = $this->config;
            $params['title'] = 'User Login';

            return View::make('Security.login', $params);
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        if ($repo->login($input)) {
            return Redirect::route('Admin.Users.Index');
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::route('Public.Login')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        $repo = App::make('UserRepository');
        if ($repo->confirmByCode($code)) {
            $notice_msg = Lang::get('confide.alerts.confirmation');

            return Redirect::route('Public.Login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide.alerts.wrong_confirmation');

            return Redirect::route('Public.Login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        $params = $this->config;
        $params['title'] = 'Forgot password';

        return View::make('Security.forgot_password', $params);
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide.alerts.password_forgot');

            return Redirect::route('Public.Login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide.alerts.wrong_password_forgot');

            return Redirect::action('User.ForgottenPassword.Get')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        $params = $this->config;
        $params['title'] = 'Reset Password';

        $user = Confide::userByResetPasswordToken($token);
        if (!$user) {
            return Redirect::route('Public.Login')->with('error', 'Wrong security token');
        }

        return View::make('Security.reset_password', $params)
            ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'token'                 => Input::get('token'),
            'password'              => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide.alerts.password_reset');

            return Redirect::route('Public.Login')->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide.alerts.wrong_password_reset');

            return Redirect::action('UsersController@resetPassword', array('token' => $input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {
        Confide::logout();

        return Redirect::to('/');
    }
}
