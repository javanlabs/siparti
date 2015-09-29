<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Entities\User;
use App\Entities\Profile;
use App\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

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
     * Save a new entity in repository
     *
     * @throws ValidatorException
     * @param array $attributes
     * @return mixed
     */
    public function createByAdmin(array $attributes)
    {
        parent::skipPresenter();

        $attributes['password_last_set'] = new Carbon();
        if(array_has($attributes, 'must_change_password')) {
            $attributes['password_last_set'] = null;
        }

        $user = parent::create($attributes);
        $this->updateProfile($attributes, $user['id']);

        return $user;
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

    public function updatePassword($password, $id)
    {
        $user = $this->skipPresenter()->find($id);
        $user->password = $password;
        $user->password_last_set = new Carbon();

        return $user->save();
    }
}
