<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;

class BackendProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDataAuth()
    {
        $id_user = Auth::user()->id;
        $name = Auth::user()->name;
        $username = Auth::user()->email;
        $level = Auth::user()->level;
        $photo_profile = Auth::user()->photo_profile;
        $arr = [];
        $arr[] = $id_user;
        $arr[] = $name;
        $arr[] = $username;
        $arr[] = $level;
        $arr[] = $photo_profile;


        echo json_encode($arr);
    }

    public function updateDataAuth(Request $request)
    {
        $id_user_profile = $request['id_user_profile'];
        $nama_user_profile = $request['nama_user_profile'];
        $email_user_profile = $request['email_user_profile'];
        $password_lama_profile = $request['password_lama_profile'];
        $password_baru_profile = $request['password_baru_profile'];

        $wizard_photo_user_profile = $request->file('wizard_photo_user_profile');


        // dd($password_baru_profile);

        if ($password_lama_profile || $password_baru_profile) {

            $password = Auth::user()->password;

            if (Hash::check($password_lama_profile, $password)) { //jika password anda benar
                // Success
                // dd('password lama benar');

                if ($password_baru_profile) { //jika password anda benar dan sudah memasukan password baru

                    if ($wizard_photo_user_profile) {

                        $photo_profile_db_lama = Auth::user()->photo_profile;

                        $destinationPath2 = public_path() . '/image/photo_profile/' . $photo_profile_db_lama;
                        File::delete($destinationPath2);

                        $filepath = time() . uniqid() . '.' . $wizard_photo_user_profile->getClientOriginalExtension();
                        $filename = $wizard_photo_user_profile->getClientOriginalName();
                        $destinationPath = public_path() . '/image/photo_profile/';
                        $wizard_photo_user_profile->move($destinationPath, $filepath);

                        // dd($filepath);

                        $update_profile = DB::table('users')
                            ->where('users.id', '=', $id_user_profile)
                            ->update([
                                'name' => $nama_user_profile,
                                'email' => $email_user_profile,
                                'password' => Hash::make($password_baru_profile),
                                'photo_profile' => $filepath
                            ]);
                        return response()->json(['response_ajax_update_profile' => 'success']);

                        // dd($filepath);
                    } else {

                        $update_profile = DB::table('users')
                            ->where('users.id', '=', $id_user_profile)
                            ->update([
                                'name' => $nama_user_profile,
                                'email' => $email_user_profile,
                                'password' => Hash::make($password_baru_profile)
                            ]);
                        return response()->json(['response_ajax_update_profile' => 'success']);
                    }
                } else if (!$password_baru_profile) { //jika password anda benar dan belum memasukan password baru
                    return response()->json(['response_ajax_update_profile' => 'failure_password_baru']);
                }
            } else { //jika password anda salah
                // dd('password lama salah');

                return response()->json(['response_ajax_update_profile' => 'failure_password_lama']);
            }
        } else {

            if ($wizard_photo_user_profile) {

                $photo_profile_db_lama = Auth::user()->photo_profile;

                $destinationPath2 = public_path() . '/image/photo_profile/' . $photo_profile_db_lama;
                File::delete($destinationPath2);
                
                $filepath = time() . uniqid() . '.' . $wizard_photo_user_profile->getClientOriginalExtension();
                $filename = $wizard_photo_user_profile->getClientOriginalName();
                $destinationPath = public_path() . '/image/photo_profile/';
                $wizard_photo_user_profile->move($destinationPath, $filepath);


                $update_profile = DB::table('users')
                    ->where('users.id', '=', $id_user_profile)
                    ->update([
                        'name' => $nama_user_profile,
                        'email' => $email_user_profile,
                        'photo_profile' => $filepath
                    ]);

                return response()->json(['response_ajax_update_profile' => 'success']);
            } else {
                $update_profile = DB::table('users')
                    ->where('users.id', '=', $id_user_profile)
                    ->update([
                        'name' => $nama_user_profile,
                        'email' => $email_user_profile
                    ]);

                return response()->json(['response_ajax_update_profile' => 'success']);
            }

            // return $this->getDataAuth();

        }


        // dd($nama_user_profile);

        // return response()->json(['success' => 'Data saved successfully!']);
        // untuk merefresh return json dengan data yang baru di update

    }
}
