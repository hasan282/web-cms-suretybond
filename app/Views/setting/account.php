<?php

$verivied = $userdata['verify_at'] !== null;

?>

<tr>
    <td class="text-bold align-middle">Full Name</td>
    <td class="align-middle"><?= userdata('nama'); ?></td>
    <td class="text-right align-middle">
        <button type="button" class="btn btn-sm btn-link">
            Change Full Name<i class="fas fa-chevron-right ml-3"></i>
        </button>
    </td>
</tr>

<?php if ($verivied) : ?>

    <tr>
        <td class="align-middle text-bold">Email Address</td>
        <td class="align-middle">
            <?= $userdata['email']; ?><i class="fas fa-check-circle text-success ml-2"></i>
        </td>
        <td class="text-right align-middle">
            <button type="button" class="btn btn-sm btn-link">
                Change Email<i class="fas fa-chevron-right ml-3"></i>
            </button>
        </td>
    </tr>

<?php else : ?>

    <tr>
        <td class="align-middle">
            <p class="text-bold mb-0">Email Address</p>
            <p class="mb-0 text-danger">
                <small>Please verify your email</small>
            </p>
        </td>
        <td class="align-middle">
            <p class="mb-1">
                <?= $userdata['email']; ?><i class="fas fa-exclamation-triangle text-warning ml-2"></i>
            </p>
            <p class="mb-0">
                <a href="/setting/verification/email" class="btn btn-default btn-sm py-0">Email Verification</a>
            </p>
        </td>
        <td class="text-right align-middle">
            <button type="button" class="btn btn-sm btn-link">
                Change Email<i class="fas fa-chevron-right ml-3"></i>
            </button>
        </td>
    </tr>

<?php endif; ?>

<tr>
    <td class="text-bold align-middle">Username</td>
    <td class="align-middle"><?= userdata('user'); ?></td>
    <td class="text-right align-middle">
        <button type="button" class="btn btn-sm btn-link">
            Change Username<i class="fas fa-chevron-right ml-3"></i>
        </button>
    </td>
</tr>

<tr>
    <td class="text-bold align-middle">Password</td>
    <td class="align-middle">*****</td>
    <td class="text-right align-middle">
        <button type="button" class="btn btn-sm btn-link">
            Change Password<i class="fas fa-chevron-right ml-3"></i>
        </button>
    </td>
</tr>