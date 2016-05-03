<?php
namespace Wash\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Wash\Http\Controllers\Controller;
use Wash\User;

class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::sorted(Input::get('sort_by'),
          Input::get('dir', 'asc'))->paginate();

        return view('admin.users.index', compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {

        $user = User::create($request->all());

        $user->save();

        flash('User Added!');

        return redirect()->route('admin.users.show', [$user->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Wash\User                          $user
     * @param \Illuminate\Support\Facades\Request $request
     *
     * @return mixed
     */
    public function update(User $user, Request $request)
    {
        $user->fill($request->all());

        $user->save();

        flash('User updated!');

        return redirect()->route('admin.users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id != Auth::user()->id) {
            $user->delete();

            flash('User deleted!');

            return redirect()->route('admin.users.index');
        }

        flash('You can not delete yourself.');

        return redirect()->route('admin.users.index');
    }

}
