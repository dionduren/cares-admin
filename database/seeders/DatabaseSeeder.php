<?php

namespace Database\Seeders;

use App\Models\GrupMember;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\ItemCategory;

use App\Models\GrupTechnical;
use App\Models\KnowledgeManagement;
use App\Models\Role;
use Illuminate\Database\Seeder;

use File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $daftar_kategori = ["Internet/Wifi", "VPN", "File Sharing", "Komputer/ Laptop", "Printer", "Zoom", "Email", "Aplikasi ERP SAP", "Aplikasi Non ERP", "Lainnya"];

        foreach ($daftar_kategori as $index => $kategori) {
            if ($kategori == "Lainnya") {
                Kategori::create([
                    'sort_order' => 999,
                    'nama_kategori' => $kategori,
                    'updated_by' => 'Seeder',
                    'created_by' => 'Seeder',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                Kategori::create([
                    'sort_order' => $index + 1,
                    'nama_kategori' => $kategori,
                    'updated_by' => 'Seeder',
                    'created_by' => 'Seeder',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $json1 = File::get("resources/json/subkategori.json");
        $json2 = File::get("resources/json/item_kategori.json");
        $json3 = File::get("resources/json/user_role.json");
        $json4 = File::get("resources/json/group_list.json");
        $json5 = File::get("resources/json/group_member.json");

        $daftar_subkategori = json_decode($json1);
        $daftar_item_kategori = json_decode($json2);
        $daftar_user_role = json_decode($json3);
        $daftar_group = json_decode($json4);
        $daftar_group_member = json_decode($json5);

        foreach ($daftar_subkategori as  $index => $subkategori) {
            $id_kategori = Kategori::where("nama_kategori", $subkategori->kategori)->first();

            $list_subkategori = [
                'id_kategori' => $id_kategori->id,
                'nama_kategori' => $subkategori->kategori,
                'nama_subkategori' => $subkategori->subkategori,
                'level_dampak' => $subkategori->level_dampak,
                'level_urgensi' => $subkategori->level_urgensi,
                'tipe_tiket' => $subkategori->tipe_tiket,
                'updated_by' => 'Seeder',
                'created_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Subkategori::create($list_subkategori);
        }

        foreach ($daftar_item_kategori as  $index => $item_kategori) {
            $id_kategori = Kategori::where("nama_kategori", $item_kategori->kategori)->first()->id;
            $id_subkategori = Subkategori::where("nama_subkategori", $item_kategori->subkategori)->first()->id;

            $list_item_kategori = [
                'id_kategori' => $id_kategori,
                'nama_kategori' => $item_kategori->kategori,
                'id_subkategori' => $id_subkategori,
                'nama_subkategori' => $item_kategori->subkategori,
                'nama_item_kategori' => $item_kategori->item_kategori,
                'level_dampak' => $item_kategori->level_dampak,
                'level_urgensi' => $item_kategori->level_urgensi,
                'tipe_tiket' => $item_kategori->tipe_tiket,
                'updated_by' => 'Seeder',
                'created_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            ItemCategory::create($list_item_kategori);
        }

        foreach ($daftar_user_role as $user_role) {

            $list_user_role = [
                'kode_role' => $user_role->kode_role,
                'nama_role' => $user_role->nama_role,
                'deskripsi_role' => $user_role->deskripsi_role,
                'updated_by' => 'Seeder',
                'created_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Role::create($list_user_role);
        }

        foreach ($daftar_group as  $index => $group) {

            $list_group = [
                'id_kategori' => $id_kategori->id,
                'nama_kategori' => $subkategori->kategori,
                'nama_subkategori' => $subkategori->subkategori,
                'level_dampak' => $subkategori->level_dampak,
                'level_urgensi' => $subkategori->level_urgensi,
                'tipe_tiket' => $subkategori->tipe_tiket,
                'updated_by' => 'Seeder',
                'created_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Subkategori::create($list_subkategori);
        }

        User::create([
            'nik' => 1180041,
            'nama' => 'Dion Alamsah',
            'password' => bcrypt('123456'),
            'email' => 'dion.alamsah@pupuk-indonesia.com',
            // 'email_verified_at' => now(),
            'unit_kerja' => 'Operasional TI',
            'role_id' => '1',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
        ]);

        User::create([
            'nik' => 'helpdesk.pi',
            'nama' => 'Helpdesk',
            'password' => bcrypt('123456'),
            'email' => 'cares@pupuk-indonesia.com',
            // 'email_verified_at' => now(),
            'unit_kerja' => 'Rendal TI',
            'role_id' => '2',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
        ]);


        User::create([
            'nik' => 121003,
            'nama' => 'Richard Martinus Halim',
            'password' => bcrypt('123456'),
            'email' => 'richard.martinus@pupuk-indonesia.com',
            'unit_kerja' => 'Infrastruktur & Layanan TI',
            // 'email_verified_at' => now(),
            'role_id' => '4',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
        ]);

        User::create([
            'nik' => 'teknisi.network',
            'nama' => 'Teknisi Network',
            'password' => bcrypt('123456'),
            'email' => 'network@pupuk-indonesia.com',
            // 'email_verified_at' => now(),
            'unit_kerja' => 'Infrastruktur & Layanan TI',
            'role_id' => '5',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
        ]);

        // GrupTechnical::create([
        //     'nama_group' => 'IT Infrastruktur',
        //     'nik_team_lead' => 121003,
        //     'nama_team_lead' => 'Richard Martinus Halim',
        //     'updated_by' => 'Seeder',
        //     'created_by' => 'Seeder',
        // ]);

        GrupMember::create([
            'id_group' => 1,
            'nama_group' => 'IT Infrastruktur',
            'nik_member' => 121003,
            'nama_member' => 'Richard Martinus Halim',
            'role_member' => 'Team Leader',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        GrupMember::create([
            'id_group' => 1,
            'nama_group' => 'IT Infrastruktur',
            'nik_member' => 'teknisi.network',
            'nama_member' => 'Teknisi Network',
            'role_member' => 'Member',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        User::create([
            'nik' => 'leader.test',
            'nama' => 'Leader Test',
            'password' => bcrypt('123456'),
            'email' => 'leader.test@pupuk-indonesia.com',
            'unit_kerja' => 'Infrastruktur & Layanan TI',
            'role_id' => '4',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
        ]);

        User::create([
            'nik' => 'teknisi.test',
            'nama' => 'Teknisi Test',
            'password' => bcrypt('123456'),
            'email' => 'teknisi.test@pupuk-indonesia.com',
            'unit_kerja' => 'Kompartemen TI',
            'role_id' => '5',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
        ]);


        // GrupTechnical::create([
        //     'nama_group' => 'Grup Technical Test',
        //     'nik_team_lead' => 'leader.test',
        //     'nama_team_lead' => 'Leader Test',
        //     'updated_by' => 'Seeder',
        //     'created_by' => 'Seeder',
        // ]);

        GrupMember::create([
            'id_group' => 2,
            'nama_group' => 'Grup Technical Test',
            'nik_member' => 'leader.test',
            'nama_member' => 'Leader Test',
            'role_member' => 'Team Leader',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        GrupMember::create([
            'id_group' => 2,
            'nama_group' => 'Grup Technical Test',
            'nik_member' => 'teknisi.test',
            'nama_member' => 'Teknisi Test',
            'role_member' => 'Member',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        KnowledgeManagement::create([
            'tipe_tiket' => 'REQUEST',
            'id_kategori' => 1,
            'kategori_tiket' => 'Internet/Wifi',
            'id_subkategori' => 17,
            'subkategori_tiket' => 'Permintaan akses internet/ wifi',
            'judul_solusi' => 'Pendaftaran Wifi Perangkat',
            'detail_solusi' => 'Mendaftarkan daftar user wifi sesuai konfigurasi dari perangkat user',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nik' => 'user.test',
            'nama' => 'User Test',
            'password' => bcrypt('123456'),
            'email' => 'user.test@pupuk-indonesia.com',
            // 'email_verified_at' => now(),
            'unit_kerja' => 'Departemen Test',
            'role_id' => '6',
            'atasan_id' => 'vp.test',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
        ]);

        User::create([
            'nik' => 'vp.test',
            'nama' => 'VP Test',
            'password' => bcrypt('123456'),
            'email' => 'vp.test@pupuk-indonesia.com',
            // 'email_verified_at' => now(),
            'unit_kerja' => 'Departemen Test',
            'role_id' => '7',
            'updated_by' => 'Seeder',
            'created_by' => 'Seeder',
        ]);
    }
}
