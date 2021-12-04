<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>Selamat Datang Administrator</h4>
            <p>
                Anda memiliki satu Fitur yang luar biasa, yaitu <b>cURL</b><br/>
                Masukan alaman website yang ingin anda cURL
            </p>
            <form action="" method="post">
                <div class="form-group row">
                    <div class="col-4">
                        <label for="url" class="control-label">Alamat URL</label>
                        <input type="url" name="url" id="url" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group row my-3">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Go</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php if(isset($result)):?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php echo $result;?>
        </div>
    </div>
</div>
<?php endif;?>