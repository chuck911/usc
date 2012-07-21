<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class QUserIdentity extends EAuthUserIdentity
{
	public $avatar;
	public $gender;
	
	public function authenticate() {		
		if ($this->service->isAuthenticated) {
			$this->id = $this->service->id;
			$this->name = $this->service->getAttribute('name');
			
			$this->setState('id', $this->id);
			$this->setState('name', $this->name);
			$this->setState('service', $this->service->serviceName);

			$this->avatar = $this->service->getAttribute('avatar');
			$this->gender = $this->service->getAttribute('gender');
			
			$this->errorCode = self::ERROR_NONE;		
		}
		else {
			$this->errorCode = self::ERROR_NOT_AUTHENTICATED;
		}
		return !$this->errorCode;
	}

	public function setLocalId($id)
	{
		$this->id = $id;
		$this->setState('id', $id);
	}
}
