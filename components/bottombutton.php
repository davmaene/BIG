<div class="btn-group col-lg-12 d-flex justify-content-center">
    <div class="w-25">
        <button class="btn btn-primary" id="gen">
            <span class="fa fa-file px-2"></span>
            <span>Générer un PDF</span>
        </button>
        <button class="btn btn-secondary" id="prt">
            <span class="fa fa-print px-2"></span>
            <span>Imprimer</span>
        </button>
    </div>
</div>
<script>
    $("#gen").on("click", e => {

    })
    $("#prt").on("click", e => {
        window.print()
    })
</script>