function setDateTimeInputs() {
    // Ambil elemen input
    const createdDateInput = document.getElementById('created_date');
    const updatedDateInput = document.getElementById('updated_date');

    // Ambil waktu sekarang di WIB (UTC+7)
    let now = new Date();

    // Hitung offset WIB (7 jam dalam ms)
    const WIB_OFFSET = 7 * 60 * 60 * 1000;

    // UTC time + offset WIB
    let nowWIB = new Date(now.getTime() + WIB_OFFSET);

    // Format ke 'YYYY-MM-DDTHH:mm'
    let year = nowWIB.getUTCFullYear();
    let month = String(nowWIB.getUTCMonth() + 1).padStart(2, '0');
    let day = String(nowWIB.getUTCDate()).padStart(2, '0');
    let hours = String(nowWIB.getUTCHours()).padStart(2, '0');
    let minutes = String(nowWIB.getUTCMinutes()).padStart(2, '0');

    let formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

    // Set value ke input
    createdDateInput.value = formattedDateTime;
    updatedDateInput.value = formattedDateTime;
}

// Panggil fungsi saat modal muncul
const exampleModal = document.getElementById('exampleModal');
exampleModal.addEventListener('show.bs.modal', setDateTimeInputs);
