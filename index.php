<?php
require_once 'init.php';
if(user() == false) exit(redirect(base_url('auth/logout')));
set_page('Dashboard');
include 'layouts/primary.php';
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="mt-5">Hi, <?= user('name') ?></h1>
        <p class="lead">Pin a footer to the bottom of the viewport in desktop browsers with this custom HTML and
            CSS. A fixed navbar has been added with <code class="small">padding-top: 60px;</code> on the <code
                class="small">main &gt; .container</code>.</p>
        <p>Back to <a href="/docs/5.2/examples/sticky-footer/">the default sticky footer</a> minus the navbar.</p>
        <pre>
        </pre>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>