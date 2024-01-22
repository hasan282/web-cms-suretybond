<?= $this->extend('layout/body_admin'); ?>

<?= $this->section('content'); ?>

<div class="mw-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="/setting">
                    <i class="fas fa-arrow-circle-left mr-2"></i>Back to Settings
                </a>
            </h3>
        </div>
        <div class="card-body">
            <div class="mw-5 mx-auto">
                <?php if ($flash !== null) : ?>
                    <p class="text-sm text-danger">
                        You cannot use the email <strong><?= $flash; ?></strong> as your email because it is already in use by another account. Please use another email.
                    </p>
                <?php endif; ?>
                <form method="post">
                    <div class="form-group">
                        <label for="emailaddr">Your Email Address</label>
                        <input type="email" id="emailaddr" name="emailaddr" class="form-control form-control-border form-control-lg" value="<?= $email; ?>" placeholder="Email">
                        <div style="height:25px">
                            <small class="text-danger ml-2" id="errormessage"></small>
                        </div>
                    </div>
                    <div class="icheck-primary text-secondary">
                        <input type="checkbox" name="verifynext" id="verifynext">
                        <label class="text-sm" for="verifynext">Send a Verification Code to Your Email <span class="text-danger">*</span></label>
                    </div>
                    <div class="text-muted px-4">
                        <small>
                            <span class="text-danger">*</span>
                            If you check this box, a verification code will be sent to your email, then you have to enter the OTP code in the form provided.
                        </small>
                    </div>
                    <div class="text-center pt-5">
                        <a class="btn btn-default mr-2 text-bold" href="/setting">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" id="savebutton" class="btn btn-primary text-bold" disabled>
                            <i class="fas fa-save mr-2"></i>Save Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    $(function() {
        let e = e => e.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/),
            t = 1;
        $("#emailaddr").on("input", function() {
            let e = $(this).val();
            1 === t && ($(this).removeClass("is-invalid"), $("#errormessage").html(""), t = 0), $("#savebutton").prop("disabled", "" == e)
        }), $('form[method="post"]').on("submit", function(a) {
            let s = $("#emailaddr");
            e(s.val()) || (a.preventDefault(), s.addClass("is-invalid"), $("#errormessage").html("The email you entered does not match the email format"), t = 1)
        })
    });
</script>

<?= $this->endSection(); ?>