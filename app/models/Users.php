<?php

namespace app\models;

/**
 * Users
 */
class Users extends \app\models\AuthUser
{

	protected $formFields = array(
		'id' => array(
			'type' => 'hidden'
		),
		'email' => array(
			'type' => 'email',
			'label' => 'Email',
			'placeholder' => 'Email',
		),
		'password' => array(
			'type' => 'password',
			'label' => 'Password',
			'placeholder' => 'Password',
		),
		'nombre' => array(
			'label' => 'Nombre',
			'placeholder' => 'Nombre',
		),
		'apellidoPaterno' => array(
			'label' => 'Apellido Paterno',
			'placeholder' => 'Apellido Paterno',
		),
		'apellidoMaterno' => array(
			'label' => 'Apellido Materno',
			'placeholder' => 'Apellido Materno',
		),
		'active' => array(
			'type' => 'checkbox',
			'label' => 'Activo?',
		),
		'emailVerified' => array(
			'type' => 'checkbox',
			'label' => 'Email verificado?',
			'readonly' => true,
			'disabled' => true,
		),
		'mustChangePassword' => array(
			'type' => 'checkbox',
			'label' => 'Debe cambiar password?'
		),
	);

	protected $validates = array(
		'email' => array(
			array(
				'notEmpty',
				'message' => 'No puede estar vacio.',
			),
			array(
				'email',
				'message' => 'Debe ser un Email valido.',
				'last' => true,
				'skipEmpty' => true,
			),
			array(
				'unique',
				'message' => 'Cuenta de correo ya registrada en el sistema.',
				'skipEmpty' => true,
				'on' => array(
					'create',
					'register',
				)
			),
		),
		'old_password' => array(
			array(
				'notEmpty',
				'message' => 'No puede estar vacio.',
				'on' => array(
					'edit_password',
				)
			),
			array(
				'equalsToDbValue',
				'field' => 'password',
				'message' => 'Password no coincide',
				'skipEmpty' => true,
				'strategy' => 'password',
				'on' => array(
					'edit_password',
				)
			),
		),
		'password_confirm' => array(
			array(
				'notEmpty',
				'message' => 'No puede estar vacio.',
				'on' => array(
					'register',
					'change_password',
					'edit_password',
				)
			),
			array(
				'confirm',
				'message' => 'Confirmacion incorrecta',
				'against' => 'password',
				'skipEmpty' => true,
				'last' => true,
				'on' => array(
					'register',
					'change_password',
					'edit_password',
				)
			),
		),
		'password' => array(
			array(
				'notEmpty',
				'message' => 'No puede estar vacio.',
				'on' => array(
					'create',
					'register',
					'change_password',
					'edit_password',
				)
			),
			array(
				'lengthBetween',
				'min' => 8,
				'message' => 'Minimo 8 caracteres.',
				'skipEmpty' => true,
				'last' => true,
			),
			array(
				'confirm',
				'message' => 'Confirmacion incorrecta',
				'against' => 'password_confirm',
				'skipEmpty' => true,
				'last' => true,
				'on' => array(
					'register',
					'change_password',
					'edit_password',
				)
			),
			array(
				'notEqualsToDbValue',
				'message' => 'No es posible usar el mismo password',
				'skipEmpty' => true,
				'strategy' => 'password',
				'on' => array(
					'change_password',
					'edit_password',
				)
			),
		),
		'nombre' => array(
			array(
				'notEmpty',
				'message' => 'No puede estar vacio.',
			),
			'lengthBetween' => array(
				'max' => 150,
				'message' => 'Minimo 8 caracteres.',
				'skipEmpty' => true,
			)
		),
		'apellidoPaterno' => array(
			array(
				'notEmpty',
				'message' => 'No puede estar vacio.',
			),
			'lengthBetween' => array(
				'max' => 150,
				'message' => 'Minimo 8 caracteres.',
				'skipEmpty' => true,
			)
		),
		'apellidoMaterno' => array(
			array(
				'notEmpty',
				'message' => 'No puede estar vacio.',
			),
			'lengthBetween' => array(
				'max' => 150,
				'message' => 'Minimo 8 caracteres.',
				'skipEmpty' => true,
			)
		),
		'active' => array(
			array(
				'boolean',
				'message' => 'Debe ser un valor booleano'
			)
		),
		'mustChangePassword' => array(
			array(
				'boolean',
				'message' => 'Debe ser un valor booleano'
			)
		),
	);

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellidoPaterno;

    /**
     * @var string
     */
    private $apellidoMaterno;


	public function __construct() {
		parent::__construct();
	}

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Personas
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidoPaterno
     *
     * @param string $apellidoPaterno
     *
     * @return Personas
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    /**
     * Get apellidoPaterno
     *
     * @return string
     */
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * Set apellidoMaterno
     *
     * @param string $apellidoMaterno
     *
     * @return Personas
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    /**
     * Get apellidoMaterno
     *
     * @return string
     */
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * Generar nombre completo
     *
     * @return string
     */
	public function getNombreCompleto() {
		return sprintf("%s %s %s",
			$this->nombre,
			$this->apellidoPaterno,
			$this->apellidoMaterno
		);
	}

    /**
     * Get "email"
     *
	 * Used by the BlameableListener
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

}
