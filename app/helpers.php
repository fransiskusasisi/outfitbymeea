<?php

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

if (!function_exists('formatTanggal')) {
  function formatTanggal($tanggal)
  {
    Carbon::setLocale('id');
    return Carbon::parse($tanggal)->translatedFormat('j F Y');
  }
}

if (!function_exists('formatTanggalDanWaktu')) {
  function formatTanggalDanWaktu($tanggal)
  {
    Carbon::setLocale('id');
    return Carbon::parse($tanggal)
      ->translatedFormat('j M Y, H:i') . ' WIB';
  }
}



if (!function_exists('formatRupiah')) {
  function formatRupiah($angka)
  {
    return 'Rp. ' . number_format(
      $angka,
      0,
      ',',
      '.'
    );
  }
}

if (!function_exists('iconEdit')) {
  function iconEdit()
  {
    return view('icons.edit-icon')->render();
  }
}

if (!function_exists('iconHapus')) {
  function iconHapus()
  {
    return view('icons.delete-icon')->render();
  }
}

if (!function_exists('iconKamera')) {
  function iconKamera()
  {
    return view('icons.kamera-icon')->render();
  }
}

if (!function_exists('iconUpdate')) {
  function iconUpdate()
  {
    return view('icons.update-icon')->render();
  }
}

if (!function_exists('role')) {
  function role()
  {
    return Auth::check() ? Auth::user()->role : null;
  }
}