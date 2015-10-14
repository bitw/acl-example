<?php namespace Bitw\Acl\Models;

use App\User as AppUser;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements RoleInterface
{
	protected $table = 'roles';

	public $timestamps = false;
	protected $fillable = ['name', 'description', 'rules'];

	/**
	 * The Users relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany(AppUser::class, 'users_roles', 'role_id', 'user_id');
	}

	/**
	 * {@inheritDoc}
	 */
	public function getRoleId()
	{
		return $this->getKey();
	}

	/**
	 * {@inheritDoc}
	 */
	public function getRoleName()
	{
		return $this->name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUsers()
	{
		return $this->users;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function getUsersModel()
	{
		return static::$usersModel;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function setUsersModel($usersModel)
	{
		static::$usersModel = $usersModel;
	}
}