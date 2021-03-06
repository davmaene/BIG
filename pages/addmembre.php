<main class="main-content  mt-5">
    <!-- <div class="page-header align-items-start min-vh-100" style="background-image: url('../assets/img/photo-1497294815431-9365093b7331.jpeg');">
      <span class="mask bg-gradient-dark opacity-6"></span> -->
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Ajout nouveau membre</h4>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" id="form-addmember">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                <input class="form-check-input" type="checkbox" id="rememberMe" name="checked" is-checked="false">
                                <label class="form-check-label mb-0 ms-2" for="rememberMe">Un compte en couple</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row d-none on-ischecked">
                                <div class="col-lg-6">
                                    <strong class="text-center">Membre 1</strong>
                                </div>
                                <div class="col-lg-6">
                                    <strong class="text-center">Membre 2</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" id="member-1">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom1" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Postnom</label>
                                <input type="text" name="postnom1" class="form-control" required>
                            </div>
                            <!-- <div class="input-group input-group-outline my-3">
                                <label class="form-label">Numero Carnet</label>
                                <input type="text" name="nn1" class="form-control" required>
                            </div> -->
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Numero de t??l??phone</label>
                                <input type="text" name="phone1" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none" id="member-2">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom2" class="form-control" >
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Postnom</label>
                                <input type="text" name="postnom2" class="form-control" >
                            </div>
                            <!-- <div class="input-group input-group-outline my-3">
                                <label class="form-label">Numero Carnet</label>
                                <input type="text" name="nn2" class="form-control" de>
                            </div> -->
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Numero de t??l??phone</label>
                                <input type="text" name="phone2" class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" id="btn-loader">
                                    <span>Enregistrer</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- </div> -->
  </main>
  <?php #include("./components/footer.php") ?>
  <script src="./assets/js/plugins/toastr/toastr.min.js"></script>
  <script>
    $("[type='checkbox']").on("change", (e) => {
       if($(e.currentTarget).attr("is-checked") === "true"){ 
            $(e.currentTarget).attr({"is-checked":"false"}) 
            $("#member-2").addClass("d-none")
            $("#member-1").addClass("col-lg-12")
            $(".on-ischecked").addClass("d-none"); 
        } else {
            $(".on-ischecked").removeClass("d-none"); 
            $(e.currentTarget).attr({"is-checked":"true"})
            $("#member-2").removeClass("d-none")
            $("#member-1").removeClass("col-lg-12").addClass("col-lg-6")
        }
    });

    $("#form-addmember").on("submit", (e) => {
        e.preventDefault()
        const ldr = document.createElement("span");
        $(ldr).attr({
            id: "loader-sp",
            class: "spinner-border spinner-border-sm ml-3"
        })
        $("#btn-loader").append(ldr)
        $.ajax({
            method: "POST",
            url: `./middleware/index.php?curl=addmember`,
            data: $(e.target).serialize()
        })
        .done(res => {
            $("#loader-sp").remove()
            try {
                const s = JSON.parse(res);
                switch (s['status']) {
                case 200:
                    $(e.currentTarget).trigger("reset");
                    toastr.success('Le compte vient d\'??tre cr??e avec succ??s !');
                    alert("Le compte vient d\'??tre cr??e avec succ??s !")
                    break;
                default:
                    toastr.error('Une erreur vient de se produire ! Veuillez r??essayer plus tard');
                    break;
                }
            } catch (error) {
                console.log(error);
                toastr.error('Une erreur vient de se produire ! Veuillez r??essayer plus tard');
            }
        })
        .fail(err => {
            $("#loader-sp").remove()
            toastr.error('Une erreur vient de se produire ! Veuillez r??essayer plus tard');
            console.log("Error => ",err);
        })
    });
  </script>