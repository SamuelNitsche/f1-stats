<?php

it('displays the standings', function () {
    \Pest\Laravel\get('/seasons/2022/13')
        ->assertOk();
});
