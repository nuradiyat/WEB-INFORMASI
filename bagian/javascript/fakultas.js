// Menambahkan event listener yang akan menjalankan fungsi ketika seluruh konten HTML sudah dimuat.
document.addEventListener('DOMContentLoaded', function () {
    // Mendapatkan semua elemen dengan kelas .faculty-button dan menyimpannya dalam variabel facultyButtons
    const facultyButtons = document.querySelectorAll('.faculty-button');
    
    // Mendapatkan semua elemen dengan kelas .departments dan menyimpannya dalam variabel departments
    const departments = document.querySelectorAll('.departments');

    // Melakukan iterasi (perulangan) pada setiap elemen dalam facultyButtons
    facultyButtons.forEach(button => {
        // Menambahkan event listener untuk mendeteksi klik pada setiap tombol fakultas
        button.addEventListener('click', function () {
            // Mendapatkan nilai atribut data-faculty dari tombol yang diklik dan menyimpannya dalam variabel selectedFaculty
            const selectedFaculty = this.getAttribute('data-faculty');

            // Melakukan iterasi pada setiap elemen dalam departments
            departments.forEach(department => {
                // Mengecek apakah id dari department sama dengan selectedFaculty
                if (department.id === selectedFaculty) {
                    // Jika sama, tambahkan kelas active ke department
                    department.classList.add('active');
                } else {
                    // Jika tidak, hapus kelas active dari department
                    department.classList.remove('active');
                }
            });
        });
    });

    // Secara otomatis mensimulasikan klik pada tombol fakultas yang memiliki data-faculty dengan nilai "teknik"
    // saat halaman pertama kali dimuat, sehingga bagian dari Fakultas Teknik langsung ditampilkan
    document.querySelector('.faculty-button[data-faculty="teknik"]').click();
});

document.getElementById('kembali-button').addEventListener('click', function() {
    window.history.back();
});