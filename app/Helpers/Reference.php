<?php

use App\Models\Site\Visitor;
use App\Models\Setting\Flash;
use App\Models\Site\TmpSurvei;

function getListUserType() {
    return ['IF' => 'IF', 'PBF' => 'PBF', 'Pemerintah' => 'Pemerintah', 'Fasyanfar' => 'Fasyanfar','Asosiasi'=>'Asosiasi', 'Akademisi' => 'Akademisi', 'Lainnya' => 'Lainnya'];
}

function getListUserSubType() {
    return ['Internal BPOM' => 'Internal BPOM', 'Apotek' => 'Apotek', 'Rumah Sakit' => 'Rumah Sakit', 'Puskesmas' => 'Puskesmas', 'Klinik' => 'Klinik', 'Toko Obat' => 'Toko Obat', 'Lainnya' => 'Lainnya'];
}

function getListUserStatus() {
    return ['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif', 'Verifikasi' => 'Verifikasi'];
}

function getListCategoryQuestion() {
    return ['Produksi Obat' => 'Produksi Obat', 'Distribusi Obat' => 'Distribusi Obat', 'Ekspor Impor' => 'Ekspor Impor', 'Registrasi Obat' => 'Registrasi Obat','Iklan dan Informasi Obat'=>'Iklan dan Informasi Obat', 'Keamanan Obat' => 'Keamanan Obat','Tembakau'=>'Tembakau','Farmakope Indonesia'=>'Farmakope Indonesia','SONK'=>'SONK', 'Lain-lain' => 'Lain-lain'];
}

function getListCategoryWbs() {
    return ['Internal' => 'Internal (Pegawai Badan POM)', 'Eksternal' => 'Eksternal (Pelaku Usaha, Masyarakat, dll)'];
}

function getListTopicWbs() {
    return ['Berkadar Pengawasan' => 'Berkadar Pengawasan', 'Tidak Berkadar Pengawasan' => 'Tidak Berkadar Pengawasan'];
}

function getListTypeRegulation() {
    return ['1' => 'PERATURAN', '2' => 'STANDAR FARMAKOPE', '3' => 'SONK'];
}

function getListTypeStandard() {
    return ['1' => 'Farmakope', '2' => 'SONK', '3' => 'Lainnya'];
}

function getListStatusConsult() {
    return ['1' => 'Ditanggapi', '2' => 'Belum Ditanggapi'];
}

function getListStatusDone() {
    return ['1' => 'Selesai', '2' => 'Belum Selesai'];
}

function getListStatusSurvey() {
    return ['1' => 'Pertanyaan', '2' => 'Pengaduan','3'=>'Konsultasi'];
}

function getFlash(){
    $out = "";
    $model = Flash::whereRaw('deleted_at is null')->get();
    foreach($model as $models){
        $out .= "<b>".$models->title.":&nbsp;</b>&nbsp;(".$models->date.")&nbsp;".$models->content."";
    }

    return $out;
}

function getVisitorToday(){
    $visit = Visitor::whereRaw('to_char(created_at,\'YYYY-MM-DD\')=\''.date('Y-m-d').'\' ')->count();

    return $visit;
}

function getVisitorWeekly(){
    $visit = Visitor::whereRaw('to_char(created_at,\'YYYY-MM-DD\') BETWEEN \''.date('Y-m-d', strtotime('-7 days')).'\' and \''.date('Y-m-d').'\' ')->count();

    return $visit;
}

function getVisitorMonthly(){
    $visit = Visitor::whereRaw('to_char(created_at,\'YYYY-MM\')=\''.date('Y-m').'\' ')->count();

    return $visit;
}

function getAllVisitor(){
    $visit = Visitor::count();

    return $visit;
}

function visitor(){
    $visit = Visitor::where('session_key',session()->getId())->count();
    if(empty($visit)){
        Visitor::create([
            'session_key' => session()->getId(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}

function setSessionVisitor(){
    return true;
}

function getCountSurvei(){
    $data = TmpSurvei::whereRaw("deleted_at is null and user_id=".session('id')." and status not in ('Done','Progress')");

    return $data->count();
}