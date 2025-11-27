<script>
function validateForm(){
    if(document.forms["formPinjam"]["fasilitas"].value === ""){
        alert("Fasilitas wajib dipilih!");
        return false;
    }

    if(document.forms["formPinjam"]["tanggal"].value === ""){
        alert("Tanggal wajib diisi!");
        return false;
    }

    if(document.forms["formPinjam"]["mulai"].value === "" ||
       document.forms["formPinjam"]["selesai"].value === "") {
        alert("Waktu mulai dan selesai wajib diisi!");
        return false;
    }

    return true;
}
</script>
