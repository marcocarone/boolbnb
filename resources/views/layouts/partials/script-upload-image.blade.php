<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>



<script type="text/javascript">
Dropzone.options.dropzone =
 {
    maxFilesize: 4,
    maxFiles: 10,
    dictDefaultMessage: 'Trascina un\'immagine qui per caricarla o fai clic per selezionarne una',
    dictRemoveFile: "Rimuovi",
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
       return time+file.name;
    },
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    timeout: 50000,
    removedfile: function(file)
    {
        var name = file.upload.filename;
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
            type: 'POST',
            url: '{{ url("upr/delete") }}',
            data: {filename: name},
            success: function (data){
                console.log("il file è stato cancellato dal database!!");
            },
            error: function(e) {
                console.log(e);
            }});
            var fileRef;
            return (fileRef = file.previewElement) != null ?
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },
    success: function(file, response)
    {
        console.log(response);
    },
    error: function(file, response)
    {
       return false;
    }
};
</script>
