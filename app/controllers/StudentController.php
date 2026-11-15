<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Student.php';
class StudentController extends Controller
{
    private Student $studentModel;
    public function __construct()
    {
        $this->studentModel = new Student();
    }
    public function index(): void
    {
        $students = $this->studentModel->all();
        $this->view('student/index', ['students' => $students]);
    }
    public function create(): void
    {
        $this->view('student/create', [
            'errors' => [],
            'old' => [],
        ]);
    }
    public function store(): void
    {
        $data = $this->ambilInputPost();
        $errors = $this->cekValidasi($data);
        if (!empty($errors)) {
            $this->view('student/create', [
                'errors' => $errors,
                'old' => $data,
            ]);
            return;
        }
        if ($this->studentModel->create($data)) {
            $this->redirect('/students');
        }
        $this->view('student/create', [
            'errors' => ['Gagal nyimpen data, cek lagi NIM nya mungkin udah kepake.'],
            'old' => $data,
        ]);
    }
    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $student = $this->studentModel->find($id);
        if ($student === false) {
            $this->redirect('/students');
        }
        $this->view('student/edit', [
            'errors' => [],
            'student' => $student,
            'old' => $student,
        ]);
    }
    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        $student = $this->studentModel->find($id);
        if ($student === false) {
            $this->redirect('/students');
        }
        $data = $this->ambilInputPost();
        $data['id'] = $id;
        $errors = $this->cekValidasi($data);
        if (!empty($errors)) {
            $this->view('student/edit', [
                'errors' => $errors,
                'student' => $student,
                'old' => $data,
            ]);
            return;
        }
        if ($this->studentModel->update($id, $data)) {
            $this->redirect('/students');
        }
        $this->view('student/edit', [
            'errors' => ['Gagal update data, cek lagi inputannya.'],
            'student' => $student,
            'old' => $data,
        ]);
    }
    public function destroy(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->studentModel->delete($id);
        }
        $this->redirect('/students');
    }
    private function ambilInputPost(): array
    {
        return [
            'nim' => trim((string) ($_POST['nim'] ?? '')),
            'name' => trim((string) ($_POST['name'] ?? '')),
            'major' => trim((string) ($_POST['major'] ?? '')),
            'semester' => trim((string) ($_POST['semester'] ?? '')),
            'gpa' => trim((string) ($_POST['gpa'] ?? '')),
        ];
    }
    private function cekValidasi(array $data): array
    {
        $errors = [];
        if ($data['nim'] === '') {
            $errors[] = 'NIM harus diisi.';
        } elseif (strlen($data['nim']) > 15) {
            $errors[] = 'NIM kepanjangan, maks 15 karakter.';
        }
        if ($data['name'] === '') {
            $errors[] = 'Nama harus diisi.';
        }
        if ($data['major'] === '') {
            $errors[] = 'Jurusan harus diisi.';
        }
        $sem = filter_var($data['semester'], FILTER_VALIDATE_INT);
        if ($sem === false || $sem < 1 || $sem > 14) {
            $errors[] = 'Semester harus angka 1 sampai 14.';
        }
        $gpaNum = is_numeric($data['gpa']) ? (float) $data['gpa'] : -1.0;
        $statusGpa = match (true) {
            $data['gpa'] === '' || !is_numeric($data['gpa']) => 'invalid',
            $gpaNum < 0.0 || $gpaNum > 4.0 => 'range',
            default => 'ok',
        };
        if ($statusGpa === 'invalid') {
            $errors[] = 'GPA harus angka.';
        } elseif ($statusGpa === 'range') {
            $errors[] = 'GPA harus antara 0.00 sampai 4.00.';
        }
        return $errors;
    }
}