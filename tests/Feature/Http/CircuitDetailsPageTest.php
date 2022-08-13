<?php

it('loads the page', function () {
    \Pest\Laravel\get('/circuits/spa')
        ->assertOk();
});
