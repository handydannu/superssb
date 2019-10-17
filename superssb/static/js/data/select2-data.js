$(document).ready(function() {
    $("#privilege").select2();
    $("#userform").select2();
    $("#category").select2({
        placeholder: "Pilih Wilayah Pemasaran"
    });
    $("#channel").select2({
        placeholder: "Select Channel"
    });
    $("#features").select2({
        placeholder: "Select Feature"
    });
    $("#author").select2({
        placeholder: "Select Author"
    });$("#editor").select2({
        placeholder: "Select Editor"
    });
    $("#province").select2({
        placeholder: "Pilih Provinsi"
    });
    $("#distributor").select2({
        placeholder: "------- Pilih Parent Distributor --------"
    });
});