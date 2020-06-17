<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?= view_cell('\App\Libraries\Breadcrumb::breadcrumb')?>


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Zarządzanie użytkownikami
                    <small>W tej sekcji możesz edytować swoje dane oraz innych użytkowników.</small>
                </h2>
                <?php if (isset($validation)): ?>
                  <div class="text-danger">
                    <?= $validation->listErrors() ?>
                  </div>
                <?php endif; ?>

                <?php if(isset($blad)): ?>
                  <div class="body bg-red">
                   <?= $blad ?>
                  </div>
                <?php endif; ?>

                <?php if(isset($success)): ?>
                  <div class="body bg-green">
                   <?= $success ?>
                  </div>
                <?php endif; ?>


                <?php if(session()->get('error')): ?>
                  <div class="body bg-red">
                   <?= session()->get('error') ?>
                  </div>
                <?php endif; ?>


                <?php if(session()->get('success')): ?>
                  <div class="body bg-green">
                   <?= session()->get('success') ?>
                  </div>
                <?php endif; ?>

                <!-- <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul> -->
            </div>
            <div class="body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#my_data" data-toggle="tab"><i class="material-icons">face</i> Moje dane</a></li>
                    <?= (session()->permission == 1) ? '<li role="presentation" ><a href="#add" data-toggle="tab"><i class="material-icons">add</i> Dodaj użytkownika</a></li>' : false ?>
                    <?= (session()->permission == 1) ? '<li role="presentation"><a href="#edit" data-toggle="tab"><i class="material-icons">edit</i> Lista użytkowników</a></li>' : false ?>
                    <?= (session()->permission == 1) ? '<li role="presentation"><a href="#remove" data-toggle="tab"><i class="material-icons">remove_circle</i> Usuń użytkownika</a></li>' : false ?>
                </ul>

                <!-- moje dane -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane animated flipInX active" id="my_data">
                        <b>Edytuj swoje dane</b><br />
                        <span class="label bg-green">Konto utworzone dnia: <?= session()->created_at ?></span>

                        <form  method="post" enctype="multipart/form-data" action="/settings/editUser">
                          <?= csrf_field() ?>
                          <?= csrf_meta() ?>
                            <input type="text" name="user_id"  readonly hidden value="<?= session()->user_id ?>">
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address">Adres Email</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="email" name="email" id="email_address" readonly class="form-control" value="<?= session()->email ?>">
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="imie">Imię</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" name="name" id="imie" class="form-control" value="<?= session()->name ?>">
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="nazwisko">Nazwisko</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" name="surname" id="nazwisko" class="form-control" value="<?= session()->surname ?>">
                                      </div>
                                  </div>
                              </div>
                            </div>


                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="company">Firma</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="text" name="company" readonly id="company" class="form-control" value="<?= $company_data['company_name'] ?>">
                                      </div>
                                  </div>
                              </div>
                            </div>


                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="birthday">Data urodzenia</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="birthday" id="birthday" class="form-control" value="<?= session()->birthday ?>">
                                    </div>
                                </div>
                            </div>
                          </div>

                          <div class="row clearfix">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="img">Obrazek profilowy</label>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                  <img src="/readfiles/showfiles/1/<?= session()->img ?>" width="48" height="48" alt="avatar">
                                    <div class="form-line">
                                        <input type="file" name="avatar" id="img" class="form-control" placeholder="Twój avatar">
                                    </div>
                                </div>
                            </div>
                          </div>


                          <div class="row ">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                  <label for="permission">Uprawnienia</label>
                              </div>
                                  <div class="col-sm-6">
                                        <select class="form-control" id="permission" name="permission" required>
                                          <?php if(session()->permission == 1){?>
                                            <option <?= (session()->permission == 1) ? 'selected' : false ?> value="1">Administrator</option>
                                            <option <?= (session()->permission == 2) ? 'selected' : false ?> value="2">Zwykły użytkownik</option>
                                          <?php }else{ ?>
                                            <option <?= (session()->permission == 2) ? 'selected' : false ?> value="2">Zwykły użytkownik</option>
                                          <?php } ?>
                                        </select>
                                    </div>
                          </div>


                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password">Hasło</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Pozostaw puste jeśli nie chcesz zmieniać">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password2">Powtórz hasło</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" name="password2" id="password2"  class="form-control" min="8" placeholder="Powtórz hasło">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Aktualizuj</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- koniec moje dane -->







                    <!-- dodaj nowego użytkownika -->
                    <div role="tabpanel" class="tab-pane flipInX" id="add">
                      <div role="tabpanel" class="tab-pane animated flipInX active" id="my_data">
                          <b>Dodaj nowego użytkownika intranetu</b><br /><br />
                          <form  method="post" enctype="multipart/form-data" action="/settings/addUser">
                            <?= csrf_field() ?>
                            <?= csrf_meta() ?>
                              <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label for="email_address">Adres Email</label>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" name="email" id="email_address" class="form-control" value="<?= set_value('email') ?>" required>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label for="imie">Imię</label>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="name" id="imie" class="form-control" value="<?= set_value('name') ?>" required>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label for="nazwisko">Nazwisko</label>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="surname" id="nazwisko" class="form-control" value="<?= set_value('surname') ?>" required>
                                        </div>
                                    </div>
                                </div>
                              </div>


                              <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label for="company">Firma</label>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="company" id="company" class="form-control" readonly value="<?= $company_data['company_name'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                              </div>


                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="birthday">Data urodzenia</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="date" name="birthday" id="birthday" class="form-control" value="<?= set_value('birthday') ?>" required>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="img">Obrazek profilowy</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                  <div class="form-group">
                                      <div class="form-line">
                                          <input type="file" name="avatar" id="img" class="form-control" placeholder="Twój avatar">
                                      </div>
                                  </div>
                              </div>
                            </div>


                            <div class="row ">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="permission">Uprawnienia</label>
                                </div>
                                    <div class="col-sm-6">
                                          <select class="form-control" id="permission" name="permission" required>
                                            <option selected readonly>-- Proszę wybrać --</option>
                                              <option value="1">Administrator</option>
                                              <option value="2">Zwykły użytkownik</option>
                                          </select>
                                      </div>
                                      <small>Administrator ma dostęp do wszystkich funkcji systemu również do takich jak dodawanie, usuwanie oraz edytowanie użytkowników. Zwykły użytkownik ma ograniczone prawa.</small>
                            </div>


                              <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label for="password">Hasło</label>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                      <div class="form-group">
                                          <div class="form-line">
                                              <input type="password" name="password" id="password" required class="form-control" min="8" placeholder="Minimum 8 znaków">
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                      <label for="password2">Powtórz hasło</label>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                      <div class="form-group">
                                          <div class="form-line">
                                              <input type="password" name="password2" id="password2" required class="form-control" min="8" placeholder="Powtórz hasło">
                                          </div>
                                      </div>
                                  </div>
                              </div>


                              <div class="row clearfix">
                                  <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">Dodaj</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                      <!-- koniec dodaj użytkownika -->
                    </div>


                    <!-- LISTA UZYTKOWNIKOW -->
                    <div role="tabpanel" class="tab-pane flipInX" id="edit">
                        <b>Lista użytkowników</b>

                                  <div class="header">
                                      <h2>
                                          Lista kont
                                      </h2>

                                  </div>
                                  <div class="body">
                                      <div class="table-responsive">
                                          <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                              <thead>
                                                  <tr>
                                                      <th>no.</th>
                                                      <th>ID użytkownika</th>
                                                      <th>Email / login</th>
                                                      <th>Imię</th>
                                                      <th>Nazwisko</th>
                                                      <th>Urodziny</th>
                                                      <th>Avatar</th>
                                                      <th>Uprawnienia</th>
                                                      <th>Ostatnio zalogowany</th>
                                                      <th>Data założonie</th>
                                                      <th>Opcje</th>
                                                  </tr>
                                              </thead>
                                              <tfoot>
                                                  <tr>
                                                    <th>no.</th>
                                                    <th>ID użytkownika</th>
                                                    <th>Email / login</th>
                                                    <th>Imię</th>
                                                    <th>Nazwisko</th>
                                                    <th>Urodziny</th>
                                                    <th>Avatar</th>
                                                    <th>Uprawnienia</th>
                                                    <th>Ostatnio zalogowany</th>
                                                    <th>Data założonie</th>
                                                    <th>Opcje</th>
                                                  </tr>
                                              </tfoot>
                                              <tbody>
                                                <?php
                                                  $i = 1;
                                                  foreach ($listUsers as $key){ ?>
                                                  <tr>
                                                      <td><?= $i++; ?></td>
                                                      <td><?= $key->user_id ?></td>
                                                      <td><?= $key->email ?></td>
                                                      <td><?= $key->name ?></td>
                                                      <td><?= $key->surname ?></td>
                                                      <td><?= $key->birthday ?></td>
                                                      <td><img src="/readfiles/showfiles/1/<?= $key->img ?> " width="48" height="48"></td>
                                                      <td><?= ($key->permission == 1) ? 'Administrator' : 'Zwykły użytkownik' ?></td>
                                                      <td><?= $key->last_logged ?></td>
                                                      <td><?= $key->created_at ?></td>
                                                      <td>
                                                        <button type="button" data-color="light-blue" data-toggle="modal" data-target="#editUserModal-<?= $key->user_id ?>" class="btn bg-light-blue waves-effect">Edytuj</button>
                                                        <button type="button" data-color="red" data-toggle="modal" data-target="#removeModal-<?= $key->user_id ?>" class="btn bg-red waves-effect">Usuń</button></td>
                                                  </tr>
                                                  <!-- usun uzytkownika -->
                                                  <?php if($key->permission == 1){?>
                                                    <div class="modal fade" id="removeModal-<?= $key->user_id ?>" tabindex="-1" role="dialog">
                                                      <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h4 class="modal-title" id="defaultModalLabel">Usuwanie użytkownika</h4>
                                                              </div>
                                                              <div class="modal-body">
                                                                Nie możesz usunąć użytkownika z <strong>prawami administratora</strong>. <br />Aby usunąć tego użytkownika zmień mu uprawnienia na zwykłego użytkownika.
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn bg-green btn-link waves-effect" data-dismiss="modal">Zamknij</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                    </div>
                                                    <?php
                                                  }else{ ?>
                                                  <div class="modal fade" id="removeModal-<?= $key->user_id ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="defaultModalLabel">Usuwanie użytkownika</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                              Czy na pewno chcesz usunąć wybranego użytkownika:
                                                              <ul>
                                                                <li>Email: <?= $key->email ?></li>
                                                                <li>Imię: <?= $key->name ?></li>
                                                                <li>Nazwisko: <?= $key->surname ?></li>
                                                              </ul>
                                                              Potwierdź usunięcie
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/settings/removeUser/<?= $key->user_id ?>" ><button type="button" class="btn bg-red btn-link waves-effect">Usuń</button></a>
                                                                <button type="button" class="btn bg-green btn-link waves-effect" data-dismiss="modal">Zamknij</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                <?php }
                                                // koniec usun uzytkownika

                                                //edytuj już istniejacego uzytkownika
                                                ?>
                                                <div class="modal fade" id="editUserModal-<?= $key->user_id ?>" tabindex="-1" role="dialog">
                                                  <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h4 class="modal-title" id="defaultModalLabel">Zmiana danych wybranego użytkownika</h4>
                                                          </div>
                                                          <div class="modal-body">

                                                          <form  method="post" enctype="multipart/form-data" action="/settings/editUser">
                                                            <?= csrf_field() ?>
                                                            <?= csrf_meta() ?>
                                                              <input type="text" name="user_id"  readonly hidden value="<?= $key->user_id ?>">
                                                              <div class="row clearfix">
                                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                      <label for="email_address">Adres Email</label>
                                                                  </div>
                                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <input type="email" name="email" id="email_address" readonly class="form-control" value="<?= $key->email ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                              <div class="row clearfix">
                                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                      <label for="imie">Imię</label>
                                                                  </div>
                                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <input type="text" name="name" id="imie" class="form-control" value="<?= $key->name ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>

                                                              <div class="row clearfix">
                                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                      <label for="nazwisko">Nazwisko</label>
                                                                  </div>
                                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <input type="text" name="surname" id="nazwisko" class="form-control" value="<?= $key->surname ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>


                                                              <div class="row clearfix">
                                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                      <label for="company">Firma</label>
                                                                  </div>
                                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <input type="text" name="company" readonly id="company" class="form-control" value="<?= $company_data['company_name'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>


                                                            <div class="row clearfix">
                                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                    <label for="birthday">Data urodzenia</label>
                                                                </div>
                                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                  <div class="form-group">
                                                                      <div class="form-line">
                                                                          <input type="date" name="birthday" id="birthday" class="form-control" value="<?= $key->birthday ?>">
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                            </div>

                                                            <div class="row clearfix">
                                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                    <label for="img">Obrazek profilowy</label>
                                                                </div>
                                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                  <div class="form-group">
                                                                    <img src="/readfiles/showfiles/1/<?= $key->img ?>" width="48" height="48" alt="avatar">
                                                                      <div class="form-line">
                                                                          <input type="file" name="avatar" id="img" class="form-control" placeholder="Twój avatar">
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                            </div>


                                                            <div class="row ">
                                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                    <label for="permission">Uprawnienia</label>
                                                                </div>
                                                                    <div class="col-sm-6">
                                                                          <select class="form-control" id="permission" name="permission" required>
                                                                              <option <?= ($key->permission == 1) ? 'selected' : false ?> value="1">Administrator</option>
                                                                              <option <?= ($key->permission == 2) ? 'selected' : false ?> value="2">Zwykły użytkownik</option>
                                                                          </select>
                                                                      </div>
                                                            </div>


                                                              <div class="row clearfix">
                                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                      <label for="password">Hasło</label>
                                                                  </div>
                                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                      <div class="form-group">
                                                                          <div class="form-line">
                                                                              <input type="password" name="password" id="password" class="form-control" placeholder="Pozostaw puste jeśli nie chcesz zmieniać">
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>

                                                              <div class="row clearfix">
                                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                      <label for="password2">Powtórz hasło</label>
                                                                  </div>
                                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                      <div class="form-group">
                                                                          <div class="form-line">
                                                                              <input type="password" name="password2" id="password2"  class="form-control" min="8" placeholder="Powtórz hasło">
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <button type="submit" class="btn bg-red btn-link waves-effect">Aktualizuj</button>
                                                              <button type="button" class="btn bg-green btn-link waves-effect" data-dismiss="modal">Zamknij</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <?php

                                                //koniec edytuj istniejacego uzytkownika
                                               } ?>

                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              <!-- </div>
                          </div>
                        </div> -->
                        <!-- KONIEC LISTA UZYTKOWNIKOW -->







                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="remove">
                        <b>Settings Content</b>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
