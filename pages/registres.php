<style>
    .bg-gradient-primary-r{
        background-color: #e91e63;
        border-color: #e91e63;
        box-shadow: 0 3px 3px 0 rgba(233, 30, 99, 0.15), 0 3px 1px -2px rgba(233, 30, 99, 0.2), 0 1px 5px 0 rgba(233, 30, 99, 0.15); 
    }
</style>
<?php 
    // $credits = getSoldeCredit("montantdu");
    // $creditsolde = $credits['solde'];
    // $creditTable = $credits['table'];
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Liste de présence | Date ( <?= date("d-m-Y") ?> ) </h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="col-lg-12" id="output"></div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 table-striped table-bordered">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Membre</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Numéro du carnet</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Numéro de téléphone</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Membre depuis</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Etat du membre</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                </tr>
              </thead>
              <tbody id="tbody">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("components/bottombutton.php") ?>
</div>
<script>
    let pts = [];

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

    $(document).ready(() => {
        $.ajax({
            method: "GET",
            url: `./middleware/index.php?curl=loadmembres`,
            data: null
        })
        .done(res => {
            $("#loader-sp").remove()
            try {
                const s = JSON.parse(res);
                switch (s['status']) {
                    case 200:
                        pts = s['body'];
                        pts.forEach(mmb => {
                            $("#tbody").append(
                                `
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm text-capitalize">${mmb['nom']}-${mmb['postnom']}</h6>
                                                    <p class="text-xs text-secondary mb-0">Numéro carnet : ${mmb['idaccount']}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Numéro du carnet</p>
                                            <p class="text-xs text-secondary mb-0">${mmb['idaccount']}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Numéro de téléphone</p>
                                            <p class="text-xs text-secondary mb-0">${mmb['phone']}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">Membre depuis</p>
                                            <p class="text-xs text-secondary mb-0">${mmb['createdon']}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">Etat du membre</p>
                                            <p class="text-xs text-secondary mb-0">${parseInt(mmb['pendingpassif']) === 1 ? "Passif" : "Actif"}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter-${mmb['id']}">
                                                    <span class="fa fa-close"></span>
                                                    Absent
                                                </button>
                                                <button class="btn btn-success">
                                                    <span class="fa fa-check"></span>
                                                    Présent
                                                </button>
                                            </div>
                                            <div class="modal fade" id="exampleModalCenter-${mmb['id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="#" id="ondeleteoperation${mmb['id']}" tag="ondeleteoperation">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Suppression d'une opération</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Vous ête sur le point de supprimer une opération; cette requête est ireversible</p>
                                                                <p>Operation ID : <strong>${mmb['comptorident']}></strong></p>
                                                                <p>Montant : <strong>${mmb['amount']}>$</strong></p>
                                                                <p>Num clinet : <strong>${mmb['phonenumber']}></strong></p>
                                                                    <input type="text" name="motif" value="">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="btn btn-group w-100">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        <span class="fa fa-close pr-1"></span>
                                                                        Annuler
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary" btn-del="exampleModalCenter-${mmb['id']}">
                                                                        <span class="fa fa-trash pr-1"></span>
                                                                        <span>Supprimer quand même</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                `
                            )
                        });
                        // console.log(pts);
                        break;
                    default:
                        // alert(1)
                        writeOutput({
                            title: "Chargement de membres", 
                            message: `Une erreur vient de se produire ! Veuillez réessayer plus tard!`,
                            type: "danger"
                        })
                        
                        break;
                }
            } catch (error) {
                $("#loader-sp").remove()
                // alert(1)
                writeOutput({
                    title: "Chargement de membres", 
                    message: `Une erreur vient de se produire ! Veuillez réessayer plus tard!`,
                    type: "danger"
                })
            }
        })
        .fail(err => {
            $("#loader-sp").remove()
            toastr.error('Une erreur vient de se produire ! Veuillez réessayer plus tard');
            console.log("Error => ",err);
        })
    });
</script>