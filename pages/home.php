<style>
    .bg-gradient-primary-h{
        background-color: #e91e63;
        border-color: #e91e63;
        box-shadow: 0 3px 3px 0 rgba(233, 30, 99, 0.15), 0 3px 1px -2px rgba(233, 30, 99, 0.2), 0 1px 5px 0 rgba(233, 30, 99, 0.15); 
    }
</style>
<?php 

    $typec = new Typecredits();

    $membres = getMemebres();
    $membres = $membres->status === 200 ? $membres->body : [];

    $parts = getSoldeContribution("parts");
    $csocials = getSoldeContribution("socials");

    $credits = getSoldeCredit("montantdu");
    $creditsolde = $credits['solde'];
    $creditTable = $credits['table'];

?>
<!-- <pre>
    <?php 
        var_dump($creditTable);
    ?>
</pre> -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute d-flex justify-content-center">
                    <!-- <i class="material-icons opacity-10">weekend</i> -->
                    <span style="font-size: 27px; align-self: center;" class="fa fa-users text-white"></span>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total membres</p>
                <h6 class="mb-0"><?= count($membres) ?></h6>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><?= count($membres) ?> </span><small>nombre de membres</small></p>
            </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute d-flex justify-content-center">
                    <span style="font-size: 27px; align-self: center;" class="fa fa-dollar text-white"></span>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Cr??dit</p>
                    <h6 class="mb-0"><?= $creditsolde ?>$</h6>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><?= count($creditTable); ?> </span><small>Totale cr??dits en cours</small> </p>
            </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute d-flex justify-content-center">
                    <!-- <i class="material-icons opacity-10">person</i> -->
                    <span style="font-size: 27px; align-self: center;" class="fa fa-heart text-white"></span>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Parts</p>
                <h6 class="mb-0"><?= $parts * 1320 ?>$</h6>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><?= $parts ?></span> nombre de parts</p>
            </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute d-flex justify-content-center">
                    <!-- <i class="material-icons opacity-10">person</i> -->
                    <span style="font-size: 27px; align-self: center;" class="fa fa-heart text-white"></span>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Sociales</p>
                <h6 class="mb-0"><?= $csocials * 5 ?>$</h6>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><?= $csocials ?></span> <small>nombre de parts</small></p>
            </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute d-flex justify-content-center">
                    <!-- <i class="material-icons opacity-10">weekend</i> -->
                    <span style="font-size: 27px; align-self: center;" class="fa fa-legal text-white"></span>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Penalit??</p>
                <h6 class="mb-0">0$</h6>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><small>0 </span>nombre de penalit??</small></p>
            </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-2">
            <div class="card">
                <a href="?page=addmembre" class="btn btn-primary">
                    <span>Ajouter un membre</span>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card">
                <a href="?page=registres" class="btn btn-secondary">
                    <span>Demarrer une r??union</span>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card">
                <a href="?page=addpart" class="btn btn-info">
                    <span>Contribution part</span>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card">
                <a href="?page=contribution" class="btn btn-warning">
                    <span>Contribution social</span>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card">
                <a href="?page=octroitcredit" class="btn btn-success">
                    <span>Octroit cr??dit</span>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card">
                <a href="?page=credit" class="btn btn-secondary">
                    <span>Remboursement</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row mb-4 mt-4">
        <div class="col-lg-7 col-md-6 mb-md-0 mb-4">
            <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                <div class="col-lg-6 col-7">
                    <h6>Cr??dits en cours</h6>
                    <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1"><?= count($creditTable) ?> cr??dits au total</span> en cours
                    </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                    <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Membres</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Montant de cr??dit</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Montant pay??</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Montant du</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($creditTable as $key => $value) {
                                global $typecredy;
                                $membres = isset($value->__tbl_membres) ? $value->__tbl_membres : [];
                                $typecredy = $typec->getOne(
                                    array(
                                        "id" => $value->type
                                    ), null, null, null
                                );

                                $typecredy = $typecredy->body;

                        ?>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm text-capitalize"><?= $membres[0]['nom']." - ".$membres[1]['postnom'] ?></h6>
                                </div>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> <?= $value->montant ?>$</span>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"><?= $value->montantpaye ?>$</span>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> <?= $value->montantdu ?>$</span>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> <?= $value->createdon ?></span>
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
        <div class="col-lg-5 col-md-6 mb-md-0 mb-4">
            <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                <div class="col-lg-6 col-7">
                    <h6>Penalit??s en cours</h6>
                    <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">0 penalit??s au total</span> en cours
                    </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                    <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                    </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="./assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Material XD Version</h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <div class="avatar-group mt-2">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                <img src="./assets/img/team-1.jpg" alt="team1">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                <img src="./assets/img/team-2.jpg" alt="team2">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                                <img src="./assets/img/team-3.jpg" alt="team3">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                <img src="./assets/img/team-4.jpg" alt="team4">
                                </a>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> $14,000 </span>
                            </td>
                            <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                                <div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">60%</span>
                                </div>
                                </div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="./assets/img/small-logos/logo-atlassian.svg" class="avatar avatar-sm me-3" alt="atlassian">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Add Progress Track</h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <div class="avatar-group mt-2">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                <img src="./assets/img/team-2.jpg" alt="team5">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                <img src="./assets/img/team-4.jpg" alt="team6">
                                </a>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> $3,000 </span>
                            </td>
                            <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                                <div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">10%</span>
                                </div>
                                </div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-info w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="./assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm me-3" alt="team7">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Fix Platform Errors</h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <div class="avatar-group mt-2">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                <img src="./assets/img/team-3.jpg" alt="team8">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                <img src="./assets/img/team-1.jpg" alt="team9">
                                </a>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> Not set </span>
                            </td>
                            <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                                <div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">100%</span>
                                </div>
                                </div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="./assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm me-3" alt="spotify">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Launch our Mobile App</h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <div class="avatar-group mt-2">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                <img src="./assets/img/team-4.jpg" alt="user1">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                <img src="./assets/img/team-3.jpg" alt="user2">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                                <img src="./assets/img/team-4.jpg" alt="user3">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                <img src="./assets/img/team-1.jpg" alt="user4">
                                </a>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> $20,500 </span>
                            </td>
                            <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                                <div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">100%</span>
                                </div>
                                </div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="./assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm me-3" alt="jira">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Add the New Pricing Page</h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <div class="avatar-group mt-2">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                <img src="./assets/img/team-4.jpg" alt="user5">
                                </a>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> $500 </span>
                            </td>
                            <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                                <div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">25%</span>
                                </div>
                                </div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-info w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="25"></div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="./assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm me-3" alt="invision">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Redesign New Online Shop</h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <div class="avatar-group mt-2">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                <img src="./assets/img/team-1.jpg" alt="user6">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                <img src="./assets/img/team-4.jpg" alt="user7">
                                </a>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> $2,000 </span>
                            </td>
                            <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                                <div class="progress-info">
                                <div class="progress-percentage">
                                    <span class="text-xs font-weight-bold">40%</span>
                                </div>
                                </div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                                </div>
                            </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- <div class="row mt-4 d-none">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 ">Website Views</h6>
                <p class="text-sm ">Last Campaign Performance</p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 "> Daily Sales </h6>
                <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> updated 4 min ago </p>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 mt-4 mb-3">
            <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                <div class="chart">
                    <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 ">Completed Tasks</h6>
                <p class="text-sm ">Last Campaign Performance</p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">just updated</p>
                </div>
            </div>
            </div>
        </div>
    </div> -->
</div>