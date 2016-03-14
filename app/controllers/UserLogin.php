<?php
/** 
*
* @Redil Software. UserLogin.php” 
* @versión: 1.0.0     @modificado: 11 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class UserLogin extends BaseController{

	public function user()
	{
		//get POST data
		$userdata = array(
			'email' => strtolower(Input::get('username')),
			'password' => Input::get('password'),
			'activo' => '1',
		);

		if(Auth::attempt($userdata))
		{
			//we are now logged in, go to admin
			return Redirect::to('inicio');
		}
		else
		{
			return Redirect::to('/')->with('login_errors', true);
		}
	}
}

?>