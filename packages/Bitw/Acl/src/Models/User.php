<?php namespace Bitw\Acl\Models;

trait User
{

	/**
	 * The Roles relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles');
	}

	public function hasRole($role)
	{
		$role = array_first($this->roles, function ($index, $instance) use ($role) {
			if ($role instanceof RoleInterface) {
				return ($instance->getRoleId() === $role->getRoleId());
			}

			if ($instance->getRoleId() == $role || $instance->getRoleName() == $role) {
				return true;
			}

			return false;
		});

		return $role !== null;
	}

	public function getRules()
	{
		$rules = '';
		foreach ($this->roles as $role) {
			$rules .= ' ' . $role->rules;
		}
		return array_filter(explode(',', preg_replace("/[,|;|\r\n|\n|\s]/mi", ',', $rules)));
	}

	public function allowRules($rule)
	{
		$allow = array_first($this->getRules(), function ($index, $instance) use ($rule) {

			if(str_is($instance, $rule)) return true;

		});

		return $allow !== null;
	}
}