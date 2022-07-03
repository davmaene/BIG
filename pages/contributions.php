<style>
    .bg-gradient-primary-cts{
        background-color: #e91e63;
        border-color: #e91e63;
        box-shadow: 0 3px 3px 0 rgba(233, 30, 99, 0.15), 0 3px 1px -2px rgba(233, 30, 99, 0.2), 0 1px 5px 0 rgba(233, 30, 99, 0.15); 
    }
</style>
<?php 

  $membres = getMemebres();
  $membres = $membres->status === 200 ? $membres->body : [];

  $parts = getContributions(array());
  // var_dump($parts);

?>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Liste des contributions par membres</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Membre</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Numéro de carnet</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Membre depuis</th>
                  <!-- <th class="text-secondary opacity-7"></th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($membres as $value) {
                ?>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="mr-2">
                        <span class="bg-primary text-white p-3 border mr-2 text-uppercase" >
                          <?= substr($value->nom, 0, 1).substr($value->postnom, 0, 1) ?>
                        </span>
                      </div>
                      <div class="d-flex flex-column justify-content-center" style="margin-left: 3px;">
                        <h6 class="mb-0 text-sm"><?= ucwords($value->nom)." ".ucwords($value->postnom) ?></h6>
                        <p class="text-xs text-secondary mb-0">Numéro <?= $value->id ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">Numéro de carnet</p>
                    <p class="text-xs text-secondary mb-0">
                      <h6><?= $value->id ?></h6>
                    </p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-success"><?= $value->pendingpassif === 1 ? "Passif" : "Actif" ?></span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold"><?= $value->createdon ?></span>
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