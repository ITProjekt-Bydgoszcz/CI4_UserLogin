<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?= view_cell('\App\Libraries\Breadcrumb::breadcrumb')?>



<div class="row clearfix">
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="card">
          <div class="header bg-green">
              <h2>
                  Użytkownicy <small>Zarządzaj użytkownikami....</small>
              </h2>
          </div>
          <div class="body">
              W tym miejscu możesz zarządzać użytkownikami systemu. Dostępne opcje to tworzenie oraz edytowanie użytkowników systemu.
              <br /><br />
              <a href="settings/users"><button type="button" class="btn btn-success waves-effect">Przejdź</button></a>
          </div>
      </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="card">
          <div class="header bg-green">
              <h2>
                  Firmy <small>Zarządzaj firmami....</small>
              </h2>
          </div>
          <div class="body">
              Znajdziesz tutaj opcje związane z firmami dostępnymi w intranecie. Tutaj możesz dodać, edytować oraz usuwać swoje firmy.
              <br /><br />
              <a href="settings/companies"><button type="button" class="btn btn-success waves-effect">Przejdź</button></a>
          </div>
      </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="card">
          <div class="header bg-green">
              <h2>
                  Ustawienia <small>Ustawienia aplikacji....</small>
              </h2>
          </div>
          <div class="body">
              W tym miejscu możesz zarządzać globalnymi ustawieniami aplikacji intranet.
              <br /><br />
              <a href="GlobalSettings/"><button type="button" class="btn btn-success waves-effect">Przejdź</button></a>
          </div>
      </div>
  </div>


</div>



<?= $this->endSection() ?>
