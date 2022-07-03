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
                <form role="form" class="text-start" id="form-connexion">
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Postnom</label>
                    <input type="text" name="postnom" class="form-control" required>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Numero NN ( Carte d'electeur )</label>
                    <input type="text" name="etatcivil" class="form-control" required>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Numero de téléphone</label>
                    <input type="text" name="phone" class="form-control" required>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" id="btn-loader">
                      <span>Connexion</span>
                      <!-- <span class="spinner-border spinner-border-sm"></span> -->
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include("./components/footer.php") ?>
    <!-- </div> -->
  </main>