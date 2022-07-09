<style>
    .bg-gradient-primary-cs{
        background-color: #e91e63;
        border-color: #e91e63;
        box-shadow: 0 3px 3px 0 rgba(233, 30, 99, 0.15), 0 3px 1px -2px rgba(233, 30, 99, 0.2), 0 1px 5px 0 rgba(233, 30, 99, 0.15); 
    }
</style>
<?php 
    $credits = getSoldeCredit("montantdu");
    $creditsolde = $credits['solde'];
    $creditTable = $credits['table'];
?>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Liste Crédits</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 table-striped table-bordered">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Membre</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Numéro du carnet</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Montant du crédit</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Montant du</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Montant payé</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date limite</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($creditTable as $key => $value) {
                    $membres = isset($value->__tbl_membres) ? $value->__tbl_membres : [];
                    $jumpto = (int) $value->type === 1 ? 4 : 1; 
                    $nmdays = _numDaysInMonth( date("m") + $jumpto );
                ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm text-capitalize"><?= $membres[0]['nom']." - ".$membres[1]['postnom'] ?></h6>
                          <p class="text-xs text-secondary mb-0">Numéro carnet : <?= $value->idaccount ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Numéro du carnet</p>
                      <p class="text-xs text-secondary mb-0"><?= $value->idaccount ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Montant</p>
                      <p class="text-xs text-secondary mb-0"><?= $value->montant ?>$</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0">Montant du</p>
                      <p class="text-xs text-secondary mb-0"><?= $value->montantdu ?>$</p>
                    </td>
                    <td class="align-middle text-center">
                      <p class="text-xs font-weight-bold mb-0">Montant payé</p>
                      <p class="text-xs text-secondary mb-0"><?= $value->montantpaye ?>$</p>
                    </td>
                    <td class="align-middle text-center">
                      <p class="text-xs font-weight-bold mb-0">Date</p>
                      <p class="text-xs text-secondary mb-0"><?= $value->createdon ?></p>
                    </td>
                    <td class="align-middle text-center">
                      <p class="text-xs font-weight-bold mb-0">Date limite</p>
                      <p class="text-xs text-secondary mb-0"><?= date('Y-m-d', strtotime($value->createdon. " + $nmdays days")) ?></p>
                    </td>
                  </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>