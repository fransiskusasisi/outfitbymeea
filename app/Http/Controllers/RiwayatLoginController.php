<?php

namespace App\Http\Controllers;

use App\Models\RiwayatLogin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RiwayatLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // 1) Buat query yang menyertakan kolom user (join)
            $query = \App\Models\RiwayatLogin::select('riwayat_login.*', 'users.nama as user_name', 'users.role as user_role')
                ->leftJoin('users', 'users.user_id', '=', 'riwayat_login.user_id')
                ->orderBy('riwayat_login.id', 'desc');

            $data = DataTables::of($query)
                ->addIndexColumn()
                // ambil dari alias yang kita select di query
                ->addColumn('user_id', function ($row) {
                    return $row->user->nama;
                })
                ->addColumn('user', function ($row) {
                    return $row->user_name;
                })
                ->addColumn('role', function ($row) {
                    return $row->user_role;
                })
                ->editColumn('login_at', function ($row) {
                    return formatTanggalDanWaktu($row->login_at);
                })
                ->editColumn('logout_at', function ($row) {
                    return $row->logout_at == null ? 'Belum Logout' : formatTanggalDanWaktu($row->logout_at);
                })
                // 2) Tangani global search agar mencari juga di kolom user_name & user_role
                ->filter(function ($query) use ($request) {
                    if ($search = $request->get('search')['value'] ?? null) {
                        $query->where(function ($q) use ($search) {
                            $q->where('users.nama', 'like', "%{$search}%")
                                ->orWhere('users.role', 'like', "%{$search}%")
                                ->orWhere('riwayat_login.ip_address', 'like', "%{$search}%")
                                // jika mau juga mencari di kolom waktu (opsional, hati2 format)
                                ->orWhere('riwayat_login.login_at', 'like', "%{$search}%");
                        });
                    }
                });

            return $data->toJson();
        }

        return view('pages.riwayatlogin.index');
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
}
