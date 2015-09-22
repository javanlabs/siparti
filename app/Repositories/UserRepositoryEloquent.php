<?php

namespace App\Repositories;

use App\Entities\Profile;
use App\Presenters\UserPresenter;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'  => 'like',
        'email' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return UserPresenter::class;
    }

    /**
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function updateProfile(array $attributes, $id)
    {
        $this->skipPresenter();
        $user = $this->find($id);

        $profile = $user->profile;
        if (!$profile) {
            $profile = new Profile();
        }
        $profile->fill(array_only($attributes, ['bio', 'timezone']));

        return $user->profile()->save($profile);
    }

    public function addEmail($email, $id)
    {
        $user = $this->skipPresenter()->find($id);

        if ($user->email == $email) {
            return false;
        }

        $token = Str::random(40);
        $saved = \DB::table('users_emails')->insert([
            'user_id'    => $id,
            'email'      => $email,
            'token'      => $token,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);

        if ($saved) {
            return $token;
        }

        return false;
    }

    public function activateEmail($token)
    {
        $email = \DB::table('users_emails')->whereToken($token)->first();

        if (!$email) {
            return false;
        }

        $data = ['email' => $email->email];
        $this->update($data, $email->user_id);

        \DB::table('users_emails')->whereEmail($email->email)->delete();

        return true;
    }

    public function updatePassword($password, $id)
    {
        $user = $this->skipPresenter()->find($id);
        $user->password = $password;

        return $user->save();
    }
}
