<?php namespace App\Http\Controllers;

use Gate;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;

class UserController extends Controller
{

	public function __construct()
	{
		Gate::define('role.assign', function ($user) {
			if ($user->allowRules('*')) return true;
		});

		Gate::define('user.edit', function ($user, $usr) {
			if ($user->allowRules('*')) return true;
			return $user->id === $usr->id;
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('user.list')->withUsers(User::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		try {
			return view('user.show')->withUser(User::find($id));
		} catch (ModelNotFoundException $e) {
			return abort(404);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		try {
			$user = User::findOrFail($id);
			if (Gate::denies('user.edit', $user)) return abort(403);
		} catch (ModelNotFoundException $e) {
			return abort(404);
		}

		return view('user.edit')
			->withUser($user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		try {
			$user = User::findOrFail($id);
			if (\Gate::denies('user.edit', $user)) return abort(403);
		} catch (ModelNotFoundException $e) {
			return abort(404);
		}

		// обновляем профиль пользователя
		$user->fill($request->all())->save();

		// Удаляем все присвоенные роли у пользователя
		$user->roles()->detach();

		// если иммеются назнаеченные роли
		if (count($request->input('roles')))
			// для оптимизации запросов выполняем добавление ролей в одну транзакцию
			\DB::transaction(function () use ($request, $user) {
				foreach ($request->input('roles') as $role_id) $user->roles()->attach($role_id);
			});

		return redirect()->route('user.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
