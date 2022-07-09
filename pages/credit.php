<main class="main-content  mt-5">
    <!-- <div class="page-header align-items-start min-vh-100" style="background-image: url('../assets/img/photo-1497294815431-9365093b7331.jpeg');">
      <span class="mask bg-gradient-dark opacity-6"></span> -->
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Remboursement crédit</h4>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" id="form-part">
                    <div class="col-lg-12" id="member-1">
                        <div class="w-100" id="output"></div>
                        <!-- <div class="row">
                            <div class="col-lg-3">
                                <span>Montant</span>
                                <h4 class="totaldposit">---</h4>
                            </div>
                            <div class="col-lg-3">
                                <span>Type de crédit</span>
                                <h4 class="typecredit">---</h4>
                            </div>
                            <div class="col-lg-3">
                                <span>Interêt</span>
                                <h4 class="interet">---</h4>
                            </div>
                            <div class="col-lg-3">
                                <span>Total à rem.</span>
                                <h4 class="totaldremb">---</h4>
                            </div>
                        </div> -->

                        <div class="divider"></div>

                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Numéro de carnet ou numéro de membre</label>
                            <input type="number" name="numcarnet" class="form-control" required>
                        </div>

                        <!-- <div class="input-group input-group-outline my-3" hidden>
                            <label class="form-label">Total montant à rembourser</label>
                            <input type="text" name="monatantremb" class="form-control">
                        </div>

                        <div class="input-group input-group-outline my-3">
                            <select name="typecredit" id="" class="form-control">
                                <option value="">Séléctionner le type de crédit</option>
                                <option value="1">Crédit Ordinaire</option>
                                <option value="2">Crédits Express</option>
                            </select>
                        </div> -->
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Montant</label>
                            <input type="number" name="montant" class="form-control" required minlength="1" required>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" id="btn-loader">
                                    <span>Confirmer</span>
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
        const valuepart = 1320;
        let pts = [];
        let canask = false;

        const writeOutput = ({ title, message, type }) => {
            $("#output").html(
                `
                    <div class="alert alert-${type}">
                        <h4 class="text-white">${title}</h4>
                        <p class="text-white">${message}</p>
                    </div>
                `
            )
        }

        const _forceUpdate = (e) => {
            // if(pts.length > 0){
            $("#output").html("")
            let typecredit = $('[name="typecredit"]').val();
            if(typecredit !== "" && typecredit !== " "){
                typecredit = parseInt(typecredit);
                switch (typecredit) {
                    case 1:
                        const configs = {
                            echeance: 4,
                            id: 1,
                            interet: 0.02,
                            libeleecheance: "mois",
                            max: 3000,
                            min: 0,
                            penalite: 0.02,
                            type: "Ordinaire"
                        }

                        if(parseFloat(e) > ( 1 + configs['min']) && parseFloat(e) <= (configs['max'])){
                            const total = (parseFloat(e) + (configs['interet'] * e));
                            $(".totaldposit").text(`${1 * (!isNaN(parseInt(e)) ? parseInt(e) : 0)}$ ( Dollars )`);
                            $(".typecredit").text(configs['type']);
                            $(".interet").text(`${configs['interet'] * 100}%`);
                            $(".totaldremb").text(`${total}$`);

                            $("[name='monatantremb']").val(total)

                        }else{
                            writeOutput({
                                title: "Remboursement crédit", 
                                message: `Le montant démandé doit etre dans l'interval de ${configs['min'] + 1} et  ${configs['max']} $`,
                                type: "danger"
                            })
                        }

                        break;
                    case 2:
                        const config = {
                            echeance: 1,
                            id: 2,
                            interet: 0.04,
                            libeleecheance: "mois",
                            max: 2000,
                            min: 0,
                            penalite: 0.02,
                            type: "Express"
                        }

                        if(parseFloat(e) > ( 1 + config['min']) && parseFloat(e) <= (config['max'])){
                            const total = (parseFloat(e) + (config['interet'] * e));
                            $(".totaldposit").text(`${1 * (!isNaN(parseInt(e)) ? parseInt(e) : 0)}$ ( Dollars )`);
                            $(".typecredit").text(config['type']);
                            $(".interet").text(`${config['interet'] * 100}%`);
                            $(".totaldremb").text(`${total}$`);

                        }else{
                            $("#output").html("");
                            writeOutput({
                                title: "Remboursement crédit", 
                                message: `Le montant démandé doit etre dans l'interval de ${config['min'] + 1} et  ${config['max']} $`,
                                type: "danger"
                            })
                        }

                        break;
                    default:
                        $("#output").html("");
                        writeOutput({
                            title: "Remboursement crédit", 
                            message: `Séléctioner le type de crédit avant de continuer !`,
                            type: "danger"
                        })
                        break;
                }
            }else{
                $("#output").html("");
                writeOutput({
                    title: "Remboursement crédit", 
                    message: `Séléctioner le type de crédit avant de continuer !`,
                    type: "danger"
                })
            }
            // }else{
            //         writeOutput({
            //             title: "Remboursement crédit", 
            //             message: `Une erreur vient de se produire ! Veuillez réessayer plus tard!`,
            //             type: "danger"
            //         })
            // }
        }

        $("[type='checkbox']").on("change", (e) => {
            if($(e.currentTarget).attr("is-checked") === "true"){ 
                $(e.currentTarget).attr({"is-checked":"false"}) 
                $("#member-2").addClass("d-none");
                $("#member-1").addClass("col-lg-12");
                $(".on-ischecked").addClass("d-none"); 
            } else {
                $(".on-ischecked").removeClass("d-none"); 
                $(e.currentTarget).attr({"is-checked":"true"});
                $("#member-2").removeClass("d-none");
                $("#member-1").removeClass("col-lg-12").addClass("col-lg-6");
            }
        });

        $("[name='valeupart']").on("focus", (e) => {
            $(e.currentTarget).val(valuepart);
        });

        $('[name="typecredit"]').on("change", (e) => {
            $("#output").html("")
            _forceUpdate($('[name="parts"]').val())
        })

        $('[name="parts"]').on("keyup", (e) => {
            $("#output").html("")
            _forceUpdate(e.currentTarget.value)
        })

        $("#form-part").on("submit", (e) => {
            e.preventDefault()
            $("#output").html("")
            const ldr = document.createElement("span");
            $(ldr).attr({
                id: "loader-sp",
                class: "spinner-border spinner-border-sm ml-3"
            })
            $("#btn-loader").append(ldr)
            $.ajax({
                method: "POST",
                url: `./middleware/index.php?curl=rembourssement`,
                data: $(e.target).serialize()
            })
            .done(res => {
                $("#loader-sp").remove()
                try {
                    const s = JSON.parse(res);
                    switch (s['status']) {
                        case 200:
                            $(e.currentTarget).trigger("reset");
                            toastr.success('Opération effectuée avec succès !');
                            // alert("Opération effectuée avec succès !");
                            writeOutput({
                                title: "Remboursement crédit", 
                                message: `Opération effectuée avec succès !`,
                                type: "success"
                            })
                            $(e).trigger("reset")
                            break;
                        case 404:
                            toastr.success('Le numéro du membre on du carnet est incorrecte !');
                            // alert("Le numéro du membre on du carnet est incorrecte !");
                            writeOutput({
                                title: "Remboursement crédit", 
                                message: `Le numéro du membre on du carnet est incorrecte !`,
                                type: "danger"
                            })
                            break;
                        default:
                            // alert("Une erreur vient de se produire ! Veuillez réessayer plus tard!")
                            writeOutput({
                                title: "Remboursement crédit", 
                                message: `Une erreur vient de se produire ! Veuillez réessayer plus tard!`,
                                type: "danger"
                            })
                            toastr.error('Une erreur vient de se produire ! Veuillez réessayer plus tard');
                            break;
                    }
                } catch (error) {
                    console.log(error);
                    $("#loader-sp").remove()
                    alert("Une erreur vient de se produire ! Veuillez réessayer plus tard!")
                    toastr.error('Une erreur vient de se produire ! Veuillez réessayer plus tard');
                }
            })
            .fail(err => {
                $("#loader-sp").remove()
                toastr.error('Une erreur vient de se produire ! Veuillez réessayer plus tard');
                console.log("Error => ",err);
            })
        });
  </script>