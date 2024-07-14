<?php

namespace App\Policies;

use App\Models\c_user;
use App\Models\t_tentang;
use Illuminate\Auth\Access\HandlesAuthorization;

class TentangPolicy
{
    use HandlesAuthorization;

    // Gate::define('form-active', function (t_tentang $tentang) {
    //     dd($tentang);
    //     // return $aksi == 2 || $aksi == 4 ||
    //     //     $aksi == 6 ||
    //     //     $aksi == 5;
    // });
    public function formActive(t_tentang $tentang)
    {
            return $tentang->verifikasiTentangJDIHLatest->aksi == 2 || $tentang->verifikasiTentangJDIHLatest->aksi == 4 ||
            $tentang->verifikasiTentangJDIHLatest->aksi == 6 ||
            $tentang->verifikasiTentangJDIHLatest->aksi == 5;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\c_user  $cUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(c_user $cUser)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\c_user  $cUser
     * @param  \App\Models\t_tentang  $tTentang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(c_user $cUser, t_tentang $tTentang)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\c_user  $cUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(c_user $cUser)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\c_user  $cUser
     * @param  \App\Models\t_tentang  $tTentang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(c_user $cUser, t_tentang $tTentang)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\c_user  $cUser
     * @param  \App\Models\t_tentang  $tTentang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(c_user $cUser, t_tentang $tTentang)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\c_user  $cUser
     * @param  \App\Models\t_tentang  $tTentang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(c_user $cUser, t_tentang $tTentang)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\c_user  $cUser
     * @param  \App\Models\t_tentang  $tTentang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(c_user $cUser, t_tentang $tTentang)
    {
        //
    }
}
