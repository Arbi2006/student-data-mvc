<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 7px; text-align: left; }
        th { background: #eee; }
        .btn { padding: 4px 8px; border: 1px solid #666; text-decoration: none; color: #000; background: #f5f5f5; }
        .btn-hapus { background: #fdd; border-color: #a00; color: #900; }
    </style>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="<?= $this->e($baseUrl) ?>/students/create" class="btn">+ Tambah Mahasiswa</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Semester</th>
                <th>GPA</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($students)): ?>
            <tr>
                <td colspan="7">Data masih kosong.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($students as $i => $mhs): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $this->e($mhs['nim']) ?></td>
                    <td><?= $this->e($mhs['name']) ?></td>
                    <td><?= $this->e($mhs['major']) ?></td>
                    <td><?= $this->e($mhs['semester']) ?></td>
                    <td><?= $this->e(number_format((float) $mhs['gpa'], 2, '.', '')) ?></td>
                    <td>
                        <a href="<?= $this->e($baseUrl) ?>/students/edit?id=<?= $this->e($mhs['id']) ?>" class="btn">Ubah</a>
                        <form action="<?= $this->e($baseUrl) ?>/students/delete" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?');">
                            <input type="hidden" name="id" value="<?= $this->e($mhs['id']) ?>">
                            <button type="submit" class="btn btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>