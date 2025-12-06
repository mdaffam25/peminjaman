<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Cek extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman'; // sesuaikan jika berbeda

    public function getFakultas()
    {
        return $this->db->table('fakultas')->get()->getResult();
    }

    public function getFasilitas()
    {
        return $this->db->table('fasilitas')->get()->getResult();
    }

    public function getRuangan()
    {
        return $this->db->table('ruangan')->get()->getResult();
    }

    /**
     * Cek bentrok berdasarkan:
     * - tanggal_peminjaman
     * - id_fasilitas
     * - id_fakultas
     * - (opsional) id_ruangan
     * - overlap waktu: new.start <= existing.end AND new.end >= existing.start
     *
     * $input harus berisi:
     *  'tanggal_peminjaman', 'waktu_mulai', 'waktu_selesai', 'fasilitas' (id), optional 'ruangan' (id), 'fakultas' (id)
     */
    public function cekFasilitas(array $input)
{
    $tanggal = $input['tanggal_peminjaman'];
    $mulai = $input['waktu_mulai'];
    $selesai = $input['waktu_selesai'];
    $id_fasilitas = $input['fasilitas'];

    $builder = $this->db->table('peminjaman');

    // JOIN
    $builder->select('peminjaman.*, fasilitas.nama_fasilitas, ruangan.nama_ruangan');
    $builder->join('fasilitas', 'fasilitas.id_fasilitas = peminjaman.id_fasilitas');
    $builder->join('ruangan', 'ruangan.id_ruangan = peminjaman.id_ruangan', 'left');

    // WHERE (fully qualified columns)
    $builder->where('peminjaman.tanggal_peminjaman', $tanggal);
    $builder->where('peminjaman.id_fasilitas', $id_fasilitas);
    $builder->where('peminjaman.id_fakultas', $input['fakultas']);

    if (!empty($input['ruangan'])) {
        $builder->where('peminjaman.id_ruangan', $input['ruangan']);
    }

    // OVERLAP TIME
    $builder->groupStart()
        ->where('peminjaman.waktu_mulai <=', $selesai)
        ->where('peminjaman.waktu_selesai >=', $mulai)
    ->groupEnd();

    return $builder->get()->getResult();
}

}
