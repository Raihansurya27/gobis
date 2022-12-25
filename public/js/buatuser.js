
const provinsi = document.getElementById('provinsi_id');
const kabupaten = document.getElementById('kabupaten_id');

provinsi.addEventListener('click', (provinsi) => {
    const nilai = provinsi.value;

    console.log(nilai)
});

// mainSelect.addEventListener('change', () => {
//   // Mendapatkan nilai yang dipilih
//   const selectedValue = mainSelect.value;

//   // Mengubah isi opsi selanjutnya sesuai dengan nilai yang dipilih
//   if (selectedValue === 'option1') {
//     nextSelect.innerHTML = '<option value="new-next-option1">New Next Option 1</option><option value="new-next-option2">New Next Option 2</option>';
//   } else if (selectedValue === 'option2') {
//     nextSelect.innerHTML = '<option value="other-next-option1">Other Next Option 1</option><option value="other-next-option2">Other Next Option 2</option>';
//   } else {
//     nextSelect.innerHTML = '<option value="default-next-option1">Default Next Option 1</option><option value="default-next-option2">Default Next Option 2</option>';
//   }
// });
