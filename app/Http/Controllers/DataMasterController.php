<?php

namespace App\Http\Controllers;

use App\Models\Kode;
use App\Models\Merek;
use App\Models\Satuan;
use App\Models\Tipe;
use App\Models\TipeMerek;
use App\Models\Unit;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DataMasterController extends Controller
{
    function getKode(Request $request)
    {
        return Kode::select()
                   ->when(
                       $request->search,
                       fn(Builder $query) => $query
                                                 ->where('prefix_kode', 'like', "%{$request->search}%")
                                                 ->orWhere('keterangan_kode', 'like', "%{$request->search}%")
                   )
                   ->when(
                       $request->exists('selected'),
                       fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                       fn(Builder $query) => $query->limit(10)
                   )
                   ->orderBy('prefix_kode')
                   ->get();
    }

    function getVendor(Request $request)
    {
        return Vendor::select()
                   ->when(
                       $request->search,
                       fn(Builder $query) => $query
                                                 ->where('prefix_vendor', 'like', "%{$request->search}%")
                                                 ->orWhere('nama_vendor', 'like', "%{$request->search}%")
                                                 ->orWhere('keterangan_vendor', 'like', "%{$request->search}%")
                   )
                   ->when(
                       $request->exists('selected'),
                       fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                       fn(Builder $query) => $query->limit(10)
                   )
                   ->orderBy('nama_vendor')
                   ->get();
    }

    function getUnit(Request $request)
    {
        return Unit::select()
                   ->when(
                       $request->search,
                       fn(Builder $query) => $query
                                                 ->where('nama_unit', 'like', "%{$request->search}%")
                   )
                   ->when(
                       $request->exists('selected'),
                       fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                       fn(Builder $query) => $query->limit(10)
                   )
                   ->orderBy('nama_unit')
                   ->get();
    }

    function getMerek(Request $request)
    {
        return Merek::select()
                   ->when(
                       $request->search,
                       fn(Builder $query) => $query
                                                 ->where('nama_merek', 'like', "%{$request->search}%")
                   )
                   ->when(
                       $request->exists('selected'),
                       fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                       fn(Builder $query) => $query->limit(10)
                   )
                   ->orderBy('nama_merek')
                   ->get();
    }

    function getTipe(Request $request)
    {
        return Tipe::select()
                   ->when(
                       $request->search,
                       fn(Builder $query) => $query
                                                 ->where('nama_tipe', 'like', "%{$request->search}%")
                   )
                   ->when(
                       $request->exists('selected'),
                       fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                       fn(Builder $query) => $query->limit(10)
                   )
                   ->orderBy('nama_tipe')
                   ->get();
    }

    function getSatuan(Request $request)
    {
        return Satuan::select()
                   ->when(
                       $request->search,
                       fn(Builder $query) => $query
                                                 ->where('nama_satuan', 'like', "%{$request->search}%")
                                                 ->orWhere('keterangan_satuan', 'like', "%{$request->search}%")
                   )
                   ->when(
                       $request->exists('selected'),
                       fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                       fn(Builder $query) => $query->limit(10)
                   )
                   ->orderBy('nama_satuan')
                   ->get();
    }

    function getTipeMerek(Request $request)
    {
        return TipeMerek::query()
                   ->with(['parentTipe', 'parentMerek'])
                   ->when(
                       $request->search,
                       fn(Builder $query) => $query
                                                 ->where('nama_tipe', 'like', "%{$request->search}%")
                                                 ->orWhere('nama_merek', 'like', "%{$request->search}%")
                   )
                   ->when(
                       $request->exists('selected'),
                       fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                       fn(Builder $query) => $query->limit(10)
                   )
                   ->get();
    }
}
