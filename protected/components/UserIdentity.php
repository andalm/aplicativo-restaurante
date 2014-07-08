<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    
    public function authenticate()
    {
        $record = $this->loadUser($this->username, Usuario::HABILITADO);
       
        if($record === null)
        {
            $this->errorCode = !self::ERROR_USERNAME_INVALID;
        }
        else if($record->contrasena !== crypt($this->password,$record->contrasena))
        {
            $this->errorCode = !self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->saveLog($record->id);
            $this->setStates($record);
            $this->errorCode = self::ERROR_NONE;
        }
        
        return $this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
    
    protected function loadUser($username, $estado)
    {
        return Usuario::model()->findByAttributes([
            'nombreUsuario' => $username,
            'estado' => $estado,
        ]);
    }
    
    protected function setStates($model)
    {
        $this->_id = $model->id;
        $this->setState('fullName', $model->fullName);
        $this->setState('name', $model->nombreUsuario);
        $this->setState('prefilId', $model->prefilId);
    }
    
    protected function saveLog($id)
    {
        $log = new Log();        
        $log->attributes = [
            'actividad' => 'Entrada la la aplicación',
            'usuarioId' => $id,
        ];
        $log->save();
    }
}
