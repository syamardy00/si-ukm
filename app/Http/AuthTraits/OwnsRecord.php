<?php
namespace App\Http\AuthTraits;
use Session;
use Illuminate\Support\Facades\Auth;

trait OwnsRecord
{
	public function pemilikAdminUkm($modelRecord)
	{
		return $modelRecord->id_ukm === Auth::guard('adminUkm')->user()->id_ukm;
	}

	public function pemilikAnggotaUkm($modelRecord)
	{
		return $modelRecord->id_ukm == Session::get('ukmDipilih');
	}
}
