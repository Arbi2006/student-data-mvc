<?php
declare(strict_types=1);
$idData = $old['id'] ?? ($student['id'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .field { margin-bottom: 10px; }
        label { display: block; margin-bottom: 3px; }
        input { padding: 5px; width: 260px; }
        .error-box { background: #fee; border: 1px solid #c00; color: #900; padding: 8px 12px; margin-bottom: 12px; width: 300px; }
    </style>
</head>
<body>
    <h2>Ubah Mahasiswa</h2>
    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= $this->e($err) ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="<?= $this->e($baseUrl) ?>/students/update" method="POST">
        <input type="hidden" name="id" value="<?= $this->e($idData) ?>">
        <div class="field">
            <label>NIM</label>
            <input type="text" name="nim" value="<?= $this->e($old['nim'] ?? '') ?>">
        </div>
        <div class="field">
            <label>Nama</label>
            <input type="text" name="name" value="<?= $this->e($old['name'] ?? '') ?>">
        </div>
        <div class="field">
            <label>Jurusan</label>
            <input type="text" name="major" value="<?= $this->e($old['major'] ?? '') ?>">
        </div>
        <div class="field">
            <label>Semester (1-14)</label>
            <input type="number" name="semester" value="<?= $this->e($old['semester'] ?? '') ?>">
        </div>
        <div class="field">
            <label>GPA (0.00-4.00)</label>
            <input type="text" name="gpa" value="<?= $this->e($old['gpa'] ?? '') ?>">
        </div>
        <button type="submit">Update</button>
        <a href="<?= $this->e($baseUrl) ?>/students">Batal</a>
    </form>
</body>
</html>