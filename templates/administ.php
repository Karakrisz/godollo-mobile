<div class="administ-container">
    <?php if ($mobileAdded) : ?>
        <div class="alert alert-success">
            Telefon rögzítve
        </div>
    <?php endif ?>
    <form class="administ-container__form" id="addMobileSubmit" action="/addMobileSubmit" method="post" enctype="multipart/form-data">
        <h3>Mobiltelefon rögzítése</h3>
        <h4 class="administ-container__form__h4">Tulajdonságok</h4>
        <fieldset>
            <input placeholder="Márka" id="brand" name="brand" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
            <input placeholder="Típus" id="type" name="type" type="text" tabindex="2" required>
        </fieldset>
        <fieldset>
            <input placeholder="Ár" id="price" name="price" type="text" tabindex="5" required></input>
        </fieldset>
        <fieldset>
            <textarea class="form-control" id="comment" name="comment" placeholder="Telefon jellemzése"></textarea>
        </fieldset>
        <input type="file" name="image" id="image" multiple accept=".jpg, .png, .gif" />
        <fieldset>
            <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Rögzítés</button>
        </fieldset>
    </form>

    <div class="administ-container__btn-box">
        <button type="button" class="btn administ-container__btn-box__btn" data-toggle="modal" data-target="#phoneModal">
            Rögzített telefonok megtekintése
        </button>
    </div>
    <!-- The Modal -->
    <div class="fade modal" id="phoneModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Telefonok</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <?php foreach ($allPhones as $phone) :
                            ?>
                                <form method="POST" action="/administ/<?php esc($phone['id']) ?>/phoneDelete">
                                    <ul>
                                        <li>
                                            <h5 class="text-left"><?php esc($phone['brand'] .=  ' ' . $phone['type'])
                                                                    ?></h5>
                                            <button type="submit" class="btn btn-danger float-right modal-body__btn">Törlés</button>
                                        </li>
                                    </ul>
                                </form>
                            <?php endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>