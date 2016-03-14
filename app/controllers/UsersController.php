<?php
class UsersController extends BaseController
{
	///funcion para validar que el usuario está logueado
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	public function getActualizarPassword () 
	{
		
			return View::make('usuarios.cambio-password');
		
	}

    public function getActualizarPasswordUsuario ($id) 
    {
        $asistente = Asistente::find($id);
        return View::make('usuarios.cambio-password-usuarios')->with(
            array(
                'asistente' => $asistente,
        ));
        
    }


	public function postUpdatePassword()
    {


        $rules = array(
            'actual' => 'required',
            'nueva' => 'required|min:5',
            'confirmar' => 'required|same:nueva'
        );

        $messages = array(
                'required' => 'La contraseña :attribute es incorrecta.',
                'min' => 'La contraseña :attribute no puede tener menos de :min carácteres.',
                'same' => 'Los campos  :attribute contraseña y :other contraseña deben concidir.'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);
        if ($validation->fails())
        {
            return Redirect::to('usuarios/actualizar-password/')->withErrors($validation)->withInput();
        }
        else{
            if (Hash::check(Input::get('actual'), Auth::user()->password))
            {
                $usuario = Auth::user();
                $usuario->password = Hash::make(Input::get('nueva'));
                $usuario->save();
               
                   
                   if($usuario->save()){
                        return Redirect::to('usuarios/actualizar-password/')->with('status', 'ok');
                   }
                   else
                   {
                       return Redirect::to('usuarios/actualizar-password/')->with('status', 'no_ok');
                    }
            }
            else
            {
                return Redirect::to('usuarios/actualizar-password/')->with('status', 'pass_invalid')->withInput();
            }

        }
    }

    public function postUpdatePasswordUser($id)
    {

        Global $asistente;

        $asistente = Asistente::find($id);
        $rules = array(
            'nueva' => 'required|min:5',
            'confirmar' => 'required|same:nueva'
        );

        $messages = array(
                'min' => 'La contraseña :attribute no puede tener menos de :min carácteres.',
                'same' => 'Los campos  :attribute contraseña y :other contraseña deben concidir.'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);
        if ($validation->fails())
        {
            return Redirect::to('usuarios/actualizar-password-usuario/'.$id)->withErrors($validation)->withInput();
        }
        else{
                $usuario = $asistente->user;
                $usuario->password = Hash::make(Input::get('nueva'));
                $usuario->save();
               
                   
               if($usuario->save()){
                    $datos= array('contra' =>Input::get('nueva'),
                      'nombre'=>$asistente->nombre,
                      'apellido'=>$asistente->apellido,
                      );

                    Mail::send('emails.cambio-password-por-administrador', $datos, function($message) 
                    {
                        $email_iglesia=User::find(1);
                        $email_iglesia=$email_iglesia->email;
                        $asistente_local=$GLOBALS['asistente'];
                        
                        $fromemail= $email_iglesia;
                        $correo= $asistente_local->user->email;
                        $message->to($correo);
                        $message->from($fromemail);
                        $message->subject('Cambio de contraseña');

                    }); 

                    return Redirect::to('usuarios/actualizar-password-usuario/'.$id)->with('status', 'ok');
                    
                    /*
                    // esto es un enseyo
                    return View::make('emails.cambio-password-por-administrador')->with(
                        array('contra' =>Input::get('nueva'),
                      'nombre'=>$asistente->nombre,
                      'apellido'=>$asistente->user->email,
                      ));
                     */       

               }
               else
               {
                   return Redirect::to('usuarios/actualizar-password-usuario/'.$id)->with('status', 'no_ok');
                }
        }
    }

}
?>