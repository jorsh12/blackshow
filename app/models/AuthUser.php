<?php

namespace app\models;

use DateTime;
use li3_doctrine\models\ValidateException;
use lithium\security\Auth;
use lithium\security\Password;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use app\extensions\util\Token;

/**
 * AuthUser
 */
abstract class AuthUser extends \app\models\SoftAuditableEntity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var \DateTime
     */
    private $lastLogin;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $mustChangePassword;

    /**
     * @var boolean
     */
    private $emailVerified;


	public function __construct() {
		parent::__construct();
		$this->active = true;
		$this->emailVerified = false;
		$this->mustChangePassword = false;
		$this->setToken();
	}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return AuthUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return AuthUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return AuthUser
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set lastLogin to now
     *
     * @return AuthUser
     */
    public function setLastLogin() {
        $this->lastLogin = new DateTime();
    }

    /**
     * Set token to generated Token
     *
     * @param string $token
     *
     * @return Users
     */
    public function setToken()
    {
        $this->token = Token::generate($this->email);

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set mustChangePassword
     *
     * @param boolean $mustChangePassword
     *
     * @return Users
     */
    public function setMustChangePassword($mustChangePassword)
    {
        $this->mustChangePassword = $mustChangePassword;

        return $this;
    }

    /**
     * Get mustChangePassword
     *
     * @return boolean
     */
    public function getMustChangePassword()
    {
        return $this->mustChangePassword;
    }

    /**
     * Set emailVerified
     *
     * @param boolean $emailVerified
     *
     * @return AuthUser
     */
    public function setEmailVerified($emailVerified)
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

    /**
     * Get emailVerified
     *
     * @return boolean
     */
    public function getEmailVerified()
    {
        return $this->emailVerified;
    }

	/**
	 * Alias for getActive()
	 *
	 * @return boolean
	 */
	public function isActive() {
		return $this->getActive();
	}

	/**
	 * Alias for getMustChangePassword()
	 *
	 * @return boolean
	 */
	public function mustChangePassword() {
		return $this->getMustChangePassword();
	}

	/**
	 * Alias for getEmailVerified()
	 *
	 * @return boolean
	 */
	public function isEmailVerified() {
		return $this->getEmailVerified();
	}


	/**
	 * Get\Set the current Authenticated user.
	 *
	 * @param mixed $request Use a `\lithium\action\Request` object to use in the Authentication
	 *        process, an `AuthUser` object to set as the current User, `false` to clear the Auth
	 *        config or null to get current authenticated user.
	 * @param string $authKey The name of the Auth config to use.
	 * @return mixed Returns `true` on clearing or seting an User, and an `AuthUser` on a correct
	 *         autentication or `null` if the user can be authenticated.
	 */
	public static function current($request = null, $authKey = 'default') {
		if ($request === false) {
			Auth::clear($authKey);
			return true;
		}
		if ($request instanceof AuthUser) {
			Auth::set($authKey, $request->data());
			return true;
		}
		if ($data = $request ? Auth::check($authKey, $request) : Auth::check($authKey)) {
			// @TODO: determinar el identificador u otro medio para buscar el usuario.
			$user = static::getRepository()->find($data['id']);
			if (!$user) {
				Auth::clear($authKey);
				return false;
			}
			return $user;
		}
		return null;
	}

	/**
	 * Hash the user password
	 */
	protected function hashPassword() {
		$this->password = Password::hash($this->password);
	}

	/**
	 * Hash the password before persisting the User
	 */
	public function onPrePersist(LifecycleEventArgs $eventArgs) {
		parent::onPrePersist($eventArgs);
		$this->hashPassword();
	}

	/**
	 * Check if there where changes to the password and reset it to the old value if the new is
	 * empty, else hash the new password.
	 */
	public function onPreUpdate(PreUpdateEventArgs $eventArgs) {
		parent::onPreUpdate($eventArgs);
		if ($eventArgs->hasChangedField('password')) {
			if (empty($this->password)) {
				$this->password = $eventArgs->getOldValue('password');
			} else {
				$this->hashPassword();
			}
		}
	}
}
