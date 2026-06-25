<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ===== USERS =====
        DB::table('users')->insert([
            ['username'=>'admin','email'=>'admin@spk.com','password'=>Hash::make('admin123'),'role'=>'admin','nama_lengkap'=>'Administrator','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['username'=>'hrd','email'=>'hrd@spk.com','password'=>Hash::make('hrd123'),'role'=>'hrd','nama_lengkap'=>'HRD Manager','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['username'=>'manager','email'=>'manager@spk.com','password'=>Hash::make('manager123'),'role'=>'manager','nama_lengkap'=>'General Manager','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // ===== 15 KARYAWAN =====
        $karyawans = [
            ['nik'=>'SPK001','nama'=>'Kholis','divisi'=>'Food & Beverage'],
            ['nik'=>'SPK002','nama'=>'Jihan','divisi'=>'Customer Service'],
            ['nik'=>'SPK003','nama'=>'Wahyu','divisi'=>'Ticketing'],
            ['nik'=>'SPK004','nama'=>'Riki','divisi'=>'Food & Beverage'],
            ['nik'=>'SPK005','nama'=>'Ayu','divisi'=>'Customer Service'],
            ['nik'=>'SPK006','nama'=>'Istivaiyah','divisi'=>'Ticketing'],
            ['nik'=>'SPK007','nama'=>'Riolando','divisi'=>'Food & Beverage'],
            ['nik'=>'SPK008','nama'=>'Samsul','divisi'=>'Customer Service'],
            ['nik'=>'SPK009','nama'=>'Cindy','divisi'=>'Ticketing'],
            ['nik'=>'SPK010','nama'=>'Sulatifah','divisi'=>'Food & Beverage'],
            ['nik'=>'SPK011','nama'=>'Emi Fajriah','divisi'=>'Customer Service'],
            ['nik'=>'SPK012','nama'=>'M. Hilman Permana','divisi'=>'Ticketing'],
            ['nik'=>'SPK013','nama'=>'Cahayani','divisi'=>'Food & Beverage'],
            ['nik'=>'SPK014','nama'=>'Faisah','divisi'=>'Customer Service'],
            ['nik'=>'SPK015','nama'=>'Akhmad Musfiq','divisi'=>'Ticketing'],
        ];

        foreach ($karyawans as $data) {
            DB::table('karyawans')->insert([
                'nik' => $data['nik'],
                'nama' => $data['nama'],
                'divisi' => $data['divisi'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // ===== 6 KRITERIA =====
        $kriterias = [
            ['nama_kriteria'=>'Kecepatan Pelayanan','bobot'=>20,'jenis'=>'benefit'],
            ['nama_kriteria'=>'Kerjasama Tim','bobot'=>15,'jenis'=>'benefit'],
            ['nama_kriteria'=>'Kehadiran dan Disiplin','bobot'=>20,'jenis'=>'benefit'],
            ['nama_kriteria'=>'Penampilan dan Kerapihan','bobot'=>10,'jenis'=>'benefit'],
            ['nama_kriteria'=>'Penjualan / Upselling','bobot'=>20,'jenis'=>'benefit'],
            ['nama_kriteria'=>'Inisiatif dan Problem Solving','bobot'=>15,'jenis'=>'benefit'],
        ];

        foreach ($kriterias as $data) {
            DB::table('kriterias')->insert([
                'nama_kriteria' => $data['nama_kriteria'],
                'bobot' => $data['bobot'],
                'jenis' => $data['jenis'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // ===== INPUT NILAI (biar pemenangnya Hilman) =====
        $periode = date('Y-m-01');
        $karyawanIds = DB::table('karyawans')->pluck('id', 'nama');
        $kriteriaIds = DB::table('kriterias')->pluck('id', 'nama_kriteria');

        // Data nilai untuk setiap karyawan (biar Hilman juara)
        $nilaiData = [
            'Kholis' => ['Kecepatan Pelayanan'=>85, 'Kerjasama Tim'=>80, 'Kehadiran dan Disiplin'=>82, 'Penampilan dan Kerapihan'=>85, 'Penjualan / Upselling'=>78, 'Inisiatif dan Problem Solving'=>80],
            'Jihan' => ['Kecepatan Pelayanan'=>82, 'Kerjasama Tim'=>85, 'Kehadiran dan Disiplin'=>88, 'Penampilan dan Kerapihan'=>82, 'Penjualan / Upselling'=>75, 'Inisiatif dan Problem Solving'=>78],
            'Wahyu' => ['Kecepatan Pelayanan'=>80, 'Kerjasama Tim'=>78, 'Kehadiran dan Disiplin'=>85, 'Penampilan dan Kerapihan'=>80, 'Penjualan / Upselling'=>85, 'Inisiatif dan Problem Solving'=>75],
            'Riki' => ['Kecepatan Pelayanan'=>78, 'Kerjasama Tim'=>82, 'Kehadiran dan Disiplin'=>80, 'Penampilan dan Kerapihan'=>78, 'Penjualan / Upselling'=>82, 'Inisiatif dan Problem Solving'=>76],
            'Ayu' => ['Kecepatan Pelayanan'=>75, 'Kerjasama Tim'=>75, 'Kehadiran dan Disiplin'=>82, 'Penampilan dan Kerapihan'=>80, 'Penjualan / Upselling'=>72, 'Inisiatif dan Problem Solving'=>75],
            'Istivaiyah' => ['Kecepatan Pelayanan'=>80, 'Kerjasama Tim'=>88, 'Kehadiran dan Disiplin'=>82, 'Penampilan dan Kerapihan'=>85, 'Penjualan / Upselling'=>78, 'Inisiatif dan Problem Solving'=>85],
            'Riolando' => ['Kecepatan Pelayanan'=>88, 'Kerjasama Tim'=>85, 'Kehadiran dan Disiplin'=>90, 'Penampilan dan Kerapihan'=>88, 'Penjualan / Upselling'=>82, 'Inisiatif dan Problem Solving'=>85],
            'Samsul' => ['Kecepatan Pelayanan'=>80, 'Kerjasama Tim'=>82, 'Kehadiran dan Disiplin'=>80, 'Penampilan dan Kerapihan'=>85, 'Penjualan / Upselling'=>75, 'Inisiatif dan Problem Solving'=>78],
            'Cindy' => ['Kecepatan Pelayanan'=>70, 'Kerjasama Tim'=>75, 'Kehadiran dan Disiplin'=>78, 'Penampilan dan Kerapihan'=>78, 'Penjualan / Upselling'=>70, 'Inisiatif dan Problem Solving'=>72],
            'Sulatifah' => ['Kecepatan Pelayanan'=>87, 'Kerjasama Tim'=>82, 'Kehadiran dan Disiplin'=>88, 'Penampilan dan Kerapihan'=>90, 'Penjualan / Upselling'=>78, 'Inisiatif dan Problem Solving'=>82],
            'Emi Fajriah' => ['Kecepatan Pelayanan'=>82, 'Kerjasama Tim'=>80, 'Kehadiran dan Disiplin'=>78, 'Penampilan dan Kerapihan'=>85, 'Penjualan / Upselling'=>78, 'Inisiatif dan Problem Solving'=>80],
            'M. Hilman Permana' => ['Kecepatan Pelayanan'=>95, 'Kerjasama Tim'=>88, 'Kehadiran dan Disiplin'=>95, 'Penampilan dan Kerapihan'=>92, 'Penjualan / Upselling'=>85, 'Inisiatif dan Problem Solving'=>90],
            'Cahayani' => ['Kecepatan Pelayanan'=>75, 'Kerjasama Tim'=>82, 'Kehadiran dan Disiplin'=>80, 'Penampilan dan Kerapihan'=>82, 'Penjualan / Upselling'=>75, 'Inisiatif dan Problem Solving'=>78],
            'Faisah' => ['Kecepatan Pelayanan'=>78, 'Kerjasama Tim'=>85, 'Kehadiran dan Disiplin'=>82, 'Penampilan dan Kerapihan'=>80, 'Penjualan / Upselling'=>82, 'Inisiatif dan Problem Solving'=>75],
            'Akhmad Musfiq' => ['Kecepatan Pelayanan'=>78, 'Kerjasama Tim'=>85, 'Kehadiran dan Disiplin'=>88, 'Penampilan dan Kerapihan'=>82, 'Penjualan / Upselling'=>80, 'Inisiatif dan Problem Solving'=>82],
        ];

        foreach ($nilaiData as $nama => $kriteriaNilai) {
            if (isset($karyawanIds[$nama])) {
                foreach ($kriteriaNilai as $kriteriaNama => $nilai) {
                    if (isset($kriteriaIds[$kriteriaNama])) {
                        DB::table('penilaians')->insert([
                            'karyawan_id' => $karyawanIds[$nama],
                            'kriteria_id' => $kriteriaIds[$kriteriaNama],
                            'nilai' => $nilai,
                            'periode' => $periode,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            }
        }
    }
}