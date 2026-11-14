<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        .box { margin-bottom: 10px; }
        label { display: block; margin-bottom: 4px; }
        input { padding: 6px; width: 280px; }
        .err { background: #ffe5e5; border: 1px solid #c00; color: #900; padding: 8px 14px; margin-bottom: 12px; width: 320px; }
    </style>
</head>
<body>
    <h2>Tambah Data Mahasiswa</h2>

    <?php if (!empty($errors)): ?>
        <div class="err">
            <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars((string) $err, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/students/store" method="POST">
        <div class="box">
            <label>NIM</label>
            <input type="text" name="nim" value="<?= htmlspecialchars((string) ($old['nim'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="box">
            <label>Nama</label>
            <input type="text" name="name" value="<?= htmlspecialchars((string) ($old['name'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="box">
            <label>Jurusan</label>
            <input type="text" name="major" value="<?= htmlspecialchars((string) ($old['major'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="box">
            <label>Semester (1-14)</label>
            <input type="number" name="semester" value="<?= htmlspecialchars((string) ($old['semester'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="box">
            <label>GPA (0.00-4.00)</label>
            <input type="text" name="gpa" value="<?= htmlspecialchars((string) ($old['gpa'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <button type="submit">Simpan</button>
        <a href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/students">Kembali</a>
    </form>
</body>
</html>