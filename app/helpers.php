<?php

use Illuminate\Support\Str;
use Carbon\Carbon;

if (!function_exists('formatTanggal')) {
  function formatTanggal($tanggal)
  {
    Carbon::setLocale('id');
    return Carbon::parse($tanggal)->translatedFormat('j F Y');
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
