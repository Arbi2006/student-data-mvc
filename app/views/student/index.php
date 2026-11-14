<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Student Data</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        table { border-collapse: collapse; width: 100%; margin-top: 12px; }
        th, td { border: 1px solid #888; padding: 8px; text-align: left; }
        th { background: #efefef; }
        .btn { display: inline-block; padding: 5px 10px; border: 1px solid #555; text-decoration: none; color: #111; background: #f7f7f7; cursor: pointer; }
        .btn-del { background: #ffe0e0; border-color: #b00; color: #900; }
    </style>
</head>
<body>
    <h2>Daftar Student Data</h2>
    <a href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/students/create" class="btn">+ Tambah Mahasiswa</a>

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
                <td colspan="7">Belum ada data mahasiwa.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($students as $idx => $row): ?>
                <tr>
                    <td><?= $idx + 1 ?></td>
                    <td><?= htmlspecialchars((string) $row['nim'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $row['major'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $row['semester'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars(number_format((float) $row['gpa'], 2, '.', ''), ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <a href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/students/edit?id=<?= htmlspecialchars((string) $row['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn">Ubah</a>
                        <form action="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/students/delete" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus data ini?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $row['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-del">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>